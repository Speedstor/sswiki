console.log("LETTTSSSSS GOOOOOOOOOOO");



window.onload = () => {
    var auto_remove_input_elems = document.getElementsByClassName("auto_remove_input");

    var auto_remove_webList_elems = document.getElementsByClassName("web_list_container");

    for(var i = 0; i < auto_remove_input_elems.length; i++){
        auto_remove_input_elems[i].addEventListener("input", function () {
            auto_input_remove_oninput(this)
        });
    }


    for(var i = 0; i < auto_remove_webList_elems.length; i++){
        var to_check_elems = auto_remove_webList_elems[i].getElementsByClassName("check_empty");
        for(var a = 0; a < to_check_elems.length; a++){
            to_check_elems[a].addEventListener("input", function(){
                auto_webList_remove_oninput(this);
            })
        }
    }

    var url_store_buttons = document.getElementsByClassName("store_link_btn");
    for(var i = 0; i < url_store_buttons.length; i++){
        url_store_buttons[i].addEventListener("click", function(){
            openUrlModel(this.id);
        })
    }
}
function escPreview() {
    document.getElementById("previewModel").style.display = "none";
    document.getElementById("iframeForm").action = "https://selfstudywiki.speedstor.net/topic/?disable_cache="+Math.floor(Math.random() * 1000000);
    
}

function confirmSubmit() {
    saveToDatabase();
    // window.location.href = "https://selfstudywiki.speedstor.net/topic/";
}

function saveToDatabase(){
    commandToDB(window.commitQuery);
}
function previewAndSave(){
    
    var submitTopicname = "*last_inserted_topicname";
    var previewJson = {
        "info": {
            "topicname": "AnotherTest",
            "last_edit": "2000-09-30 14:51:34",
            "popularity": "10",
            "tutorial_finished": "0"
        },
        "tutorial": {},
        "tips": {},
        "fun": {},
        "toolbox": {},
        "general": {},
        "deepDive": {},
        "editHistory": {},
        "editPending": {},
        "rateHistory": {}
    }
    
    let query = ""
    var topicTitle = document.getElementById("input_topic_title").value;
    var description = document.getElementById("textarea_topic_description").value;
    if(document.getElementById("input_topic_title").classList.contains("existed_item") && window.location.href.includes("/edit.php")){
        if(topicTitle != document.getElementById("input_topic_title").getAttribute("data-original") || description != document.getElementById("textarea_topic_description").getAttribute("data-original"))
            query += `edit\tinfo\t${topicTitle}\t${description};`;
        submitTopicname = window.topicname;
    }else{
        //all new
        window.create_topic = true;
        if(topicTitle == "" || description == ""){
            document.getElementById("input_topic_title").style.border = "1px solid red";
            document.getElementById("textarea_topic_description").style.border = "1px solid red";
            return "Title and Description are required";
        }
        
        query += `createtopicsuite\t${topicTitle}\t${description};`;
    }
    previewJson.info.topic_title = topicTitle;
    previewJson.info.description = description;
    
    
    query += getList("tutorial", submitTopicname, previewJson);
    query += getList("tips", submitTopicname, previewJson);
    query += getList("fun", submitTopicname, previewJson);
    query += getList("toolbox", submitTopicname, previewJson);

    query += getContainerList("general", submitTopicname, previewJson);
    query += getContainerList("deepDive", submitTopicname, previewJson);
    
    window.commitQuery = query;
    console.log(query.replaceAll(";", "\n"));
    console.log(previewJson);

    document.getElementById("givenJsonParam").value = JSON.stringify(previewJson);
    document.getElementById("iframeForm").action = "https://selfstudywiki.speedstor.net/topic/?disable_cache="+Math.floor(Math.random() * 1000000);
    document.getElementById("iframeForm").submit();
    document.getElementById("previewModel").style.display = "block";
    
    // document.getElementById("previewIframe");
    // commandToDB(query);
}


function getContainerList(category, topicname, previewJson){
    var generalContainers = document.getElementsByClassName(category+"_container");
    var query = "";
    for(var i = 0; i < generalContainers.length; i++){
        let any_item_changed = false;
        var focusedElem = generalContainers[i];
        var specialId = focusedElem.getAttribute("data-id");

        var title = document.getElementById(category+"_title_"+specialId).value;
        console.log(title, document.getElementById(category+"_title_"+specialId).getAttribute("data-original"))
        if(title != document.getElementById(category+"_title_"+specialId).getAttribute("data-original")) any_item_changed = true;
        if(title == "") continue;
        var mainlink = document.getElementById(category+"_mainlink_"+specialId).getAttribute("data-link");
        if(mainlink != document.getElementById(category+"_mainlink_"+specialId).getAttribute("data-original")) any_item_changed = true;
        if(mainlink == 0 || mainlink == "" || mainlink == null) mainlink = "NULL";
        var picturelink = document.getElementById(category+"_picturelink_"+specialId).value;
        if(picturelink != document.getElementById(category+"_picturelink_"+specialId).getAttribute("data-original")) any_item_changed = true;


        var siteMapJson = "[";
        for(var a = 0; a < 6; a++){
            var subtitle_id = category+"_subtitle_"+specialId+"_"+a;
            var sublink_id = category+"_sublink_"+specialId+"_"+a;

            var subtitle = document.getElementById(subtitle_id).value;
            if(subtitle != document.getElementById(subtitle_id).getAttribute("data-original")) any_item_changed = true;
            var link = document.getElementById(sublink_id).getAttribute("data-link");
            if(subtitle == "") continue;
            let original_link = document.getElementById(sublink_id).getAttribute("data-original");
            if(original_link == 0 || original_link == "" || original_link == null) original_link = "false";
            if(link != original_link) any_item_changed = true;

            siteMapJson += `{"title": "${subtitle}", "link": "${link}"},`;
        }
        if(siteMapJson.length > 1) siteMapJson = siteMapJson.substring(0, siteMapJson.length - 1) + "]";
        else siteMapJson = "[]";

        var is_book = document.querySelector('input[name="'+category+'_is_book_'+specialId+'"]:checked').value;
        if(is_book){
            if(is_book == "book") is_book = 1;
            else is_book = 0;
        }else{
            is_book = 0;
        }

        previewJson[category][i] = {
            "id": "1",
            "title": title,
            "whatId": "TheBestTopic_general_1",
            "edit_increment": "0",
            "main_link": mainlink,
            "picture_link": picturelink,
            "sitemap_json": siteMapJson,
            "is_book": is_book,
            "compiled_rating": "10",
            "positive_rating": "0",
            "negative_rating": "0",
            "rating_id": "13"
        }

        if(window.create_topic){
            query += `insertdb\t${category}\t${topicname}\t${title}\t${mainlink}\t${picturelink}\t${siteMapJson}\t${is_book};`;
        }else{
            if(focusedElem.classList.contains("existed_item")){
                if(any_item_changed) query += `edit\t${category}\t${topicname}\t${specialId}\t${title}\t${mainlink}\t${picturelink}\t${siteMapJson}\t${is_book};`;
            }else{
                query += `editinsert\t${category}\t${topicname}\t${specialId}\t${title}\t${mainlink}\t${picturelink}\t${siteMapJson}\t${is_book};`;
            }
        }
    }
    return query;
}

function getList(category, topicname, previewJson){
    var listLinksElems = document.getElementsByClassName(category+"_title");
    var query = "";
    
    for(var i = 0; i < listLinksElems.length; i++){
        var any_item_changed = false;
        var focusedElem = listLinksElems[i];
        if(!focusedElem.hasAttribute("data-id")) continue;
        var specialId = focusedElem.getAttribute("data-id");


        var title = focusedElem.value;
        if(title != focusedElem.getAttribute("data-original")) any_item_changed = true;
        var link = document.getElementById(category+"_link_"+specialId).getAttribute("data-link");
        if(link == 0 || link == "" || link == null) link = "NULL";
        let original_link = document.getElementById(category+"_link_"+specialId).getAttribute("data-original");
        if(original_link == 0 || original_link == "" || original_link == null) original_link = "NULL";
        if(link != original_link) any_item_changed = true;
        if(title == "") continue;
        previewJson[category][i] = {
            "id": i,
            "title": title,
            "whatId": "TEST_tutorial_4",
            "edit_increment": "0",
            "link": link,
            "compiled_rating": "10",
            "positive_rating": "0",
            "negative_rating": "0",
            "rating_id": "19"
        }
        console.log(focusedElem.classList.contains("existed_item"), any_item_changed);

        if(window.create_topic){
            query += `insertdb\t${category}\t${topicname}\t${title}\t${link};`;
        }else{
            console.log("hitted")
            if(focusedElem.classList.contains("existed_item")){
                if(any_item_changed) query += `edit\t${category}\t${topicname}\t${specialId}\t${title}\t${link};`;
            }else{
                console.log("editinsert1")

                query += `editinsert\t${category}\t${topicname}\t${specialId}\t${title}\t${link};`;
            }
        }
    }

    return query;
}

function commandToDB(query){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "https://selfstudywiki.speedstor.net/secure/command.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        "query": query,
        "secret4356": "not needed"
    }));

}

function openUrlModel(setting_for){
    var urlModel_input = document.getElementById("url_input");
    urlModel_input.style.border = "1px solid grey";
    urlModel_input.setAttribute("data-setting-for", setting_for);
    urlModel_input.placeholder = "url...";
    var tempElem = document.getElementById(setting_for);
    if(tempElem.hasAttribute("data-link")){
        urlModel_input.value = tempElem.getAttribute("data-link");
    }else{
        urlModel_input.value = "";
    }
    document.getElementById("urlModel").style.display = "block";

}

function setUrlFromModel(){
    var urlModel_input = document.getElementById("url_input");
    if(urlModel_input.value == ""){
        urlModel_input.placeholder = "Please input an url";
        urlModel_input.style.border = "1px solid red";
        return;
    }
    if(urlModel_input.getAttribute("data-setting-for") != "" && document.getElementById(urlModel_input.getAttribute("data-setting-for"))){
        var setFor = document.getElementById(urlModel_input.getAttribute("data-setting-for"));
        urlModel_input.setAttribute("data-setting-for", "")
        setFor.setAttribute("data-link", urlModel_input.value)
        urlModel_input.value = "";
        
        setFor.classList.remove("field_empty");
        setFor.classList.add("field_filled");
    }
    escapeUrlModel();
}
function setEmptyFromModel(){
    var urlModel_input = document.getElementById("url_input");

    var setFor = document.getElementById(urlModel_input.getAttribute("data-setting-for"));
    urlModel_input.setAttribute("data-setting-for", "")
    setFor.setAttribute("data-link", "")
    urlModel_input.value = "";

    setFor.classList.add("field_empty");
    setFor.classList.remove("field_filled");

    escapeUrlModel();
}

function escapeUrlModel(){
    var urlModel_input = document.getElementById("url_input");
    document.getElementById("urlModel").style.display = "none";
    urlModel_input.style.border = "1px solid grey";
    urlModel_input.setAttribute("data-setting-for", "");
    urlModel_input.placeholder = "url...";
}
function showUrlModel(){
    document.getElementById("urlModel").style.display = "block";
}

function auto_webList_remove_oninput(webList){
    var categoryType = webList.id.split("_")[0];
    var parentContainer = document.getElementById(categoryType+"_container_"+webList.getAttribute("data-id"));


    var if_all_empty = true;
    var to_check = parentContainer.getElementsByClassName("check_empty");
    for(var i = 0; i < to_check.length; i++){
        if(to_check[i].value != ""){
            if_all_empty = false;
            break;
        }
    }


    if(parentContainer.classList.contains("bottom_input")){
        if(!if_all_empty){
            //add a webList

            var elem_type = categoryType+"_conatiner";

            var new_webList = document.createElement("LI");

            var specialId = Math.floor(Math.random() * 9999999);
            while(document.getElementById(elem_type + "_" + specialId)){
                specialId = Math.floor(Math.random() * 9999999);
            }


            new_webList.classList.add("web_list_container", categoryType+"_container", "bottom_input");
            new_webList.id = categoryType+"_container_"+specialId;
            new_webList.setAttribute("data-type", elem_type);
            new_webList.setAttribute("data-id", specialId);

            new_webList.innerHTML = `<div class="box intrude horizontal" style="flex: auto; align-items: strech; max-height: 198px;">
            <div style="display: flex; flex-direction: column; align-items: center; background: #dadada; box-shadow: inset -1px 1px 5px 1px rgba(125, 125, 125, 0.29);">
                <button class="btn btn-icon" style="padding: 0px 3px; height: 18px; margin-bottom: 2px; margin-top: 8px; color: red;"><i class="fas fa-trash"></i></button>
            </div>
            <div class="box-margin-thin">
                <div class="sub no-margin">
                    <label><input type="radio" checked id="${categoryType}_website_${specialId}" data-id='${specialId}' name="${categoryType}_is_book_${specialId}" value="website">Website</label>
                    <label><input type="radio"  id="${categoryType}_book_${specialId}" data-id='${specialId}' name="${categoryType}_is_book_${specialId}" value="book">Book</label>
                </div>
                <div class="indent">
                    <h3 class="thin no-margin"><input type="text" id="${categoryType}_title_${specialId}" data-id='${specialId}' class="check_empty"/><button id="${categoryType}_mainlink_${specialId}" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_mainlink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></h3>
                    <ul class="plain" style="columns: 2; padding-top: 8px;">
                        <li class="topic-sublink"><input id="${categoryType}_subtitle_${specialId}_0" data-id='${specialId}' class="<?php echo $web_list_list_type; ?>_subtitle_${specialId} check_empty" type="text"/> <button id="${categoryType}_sublink_${specialId}_0" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_sublink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                        <li class="topic-sublink"><input id="${categoryType}_subtitle_${specialId}_1" data-id='${specialId}' class="<?php echo $web_list_list_type; ?>_subtitle_${specialId} check_empty" type="text"/> <button id="${categoryType}_sublink_${specialId}_1" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_sublink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                        <li class="topic-sublink"><input id="${categoryType}_subtitle_${specialId}_2" data-id='${specialId}' class="<?php echo $web_list_list_type; ?>_subtitle_${specialId} check_empty" type="text"/> <button id="${categoryType}_sublink_${specialId}_2" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_sublink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                        <li class="topic-sublink"><input id="${categoryType}_subtitle_${specialId}_3" data-id='${specialId}' class="<?php echo $web_list_list_type; ?>_subtitle_${specialId} check_empty" type="text"/> <button id="${categoryType}_sublink_${specialId}_3" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_sublink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                        <li class="topic-sublink"><input id="${categoryType}_subtitle_${specialId}_4" data-id='${specialId}' class="<?php echo $web_list_list_type; ?>_subtitle_${specialId} check_empty" type="text"/> <button id="${categoryType}_sublink_${specialId}_4" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_sublink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                        <li class="topic-sublink"><input id="${categoryType}_subtitle_${specialId}_5" data-id='${specialId}' class="<?php echo $web_list_list_type; ?>_subtitle_${specialId} check_empty" type="text"/> <button id="${categoryType}_sublink_${specialId}_5" data-id='${specialId}' class="btn btn-icon <?php echo $web_list_list_type; ?>_sublink_${specialId} store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                    </ul>
                </div>
            </div>
            <div class="" style="display: flex; align-content: center; justify-content: center; flex-direction: column; height: 198px; width: 258px; border: 1px solid grey; padding: 15px; box-sizing: border-box;">
                <div style="display: flex;"><i class="fas fa-link" style="margin-right: 4px; color: rgb(49, 133, 189);"></i><input type="text" id="${categoryType}_picturelink_${specialId}" data-id='${specialId}' class="check_empty"/></div>
                <p style="text-align: center;">~ or ~</p>
                <button class="btn btn-green">Upload <i class="fas fa-upload"></i></button>
            </div>
        </div>`;

            insertAfter(new_webList, parentContainer);

            parentContainer.classList.remove("bottom_input");

            //add event listener
            var to_check_elems = new_webList.getElementsByClassName("check_empty");
            for(var a = 0; a < to_check_elems.length; a++){
                to_check_elems[a].addEventListener("input", function(){
                    auto_webList_remove_oninput(this)
                })
            }

            var url_store_buttons = new_webList.getElementsByClassName("store_link_btn");
            for(var i = 0; i < url_store_buttons.length; i++){
                url_store_buttons[i].addEventListener("click", function(){
                    openUrlModel(this.id);
                })
            }
        }

    }else{
        if(if_all_empty){
            //delete element
            parentContainer.remove();
        }
    }
}

function auto_input_remove_oninput(input){
    if(input.value == ""){
        if(!input.classList.contains("bottom_input")){
            //check if it is previously in database
                //if it is in database, log it in edit file
                //if not in database, just delete
                input.parentNode.remove();
        }
    }else{
        if(input.classList.contains("bottom_input")){
            //add one input below it with bottom_input class
            var elem_type = input.getAttribute("data-type");

            var new_input = document.createElement("LI");
            var titleInput = document.createElement("INPUT");
            titleInput.classList.add(elem_type+"_link", elem_type, "auto_remove_input");
            titleInput.type = 'text';

            var specialId = Math.floor(Math.random() * 9999999);
            while(document.getElementById(elem_type + "_" + specialId)){
                specialId = Math.floor(Math.random() * 9999999);
            }

            titleInput.setAttribute("data-id", ''+specialId);
            titleInput.setAttribute("data-type", elem_type);
            titleInput.id = elem_type + "_" + specialId;

            titleInput.classList.add("bottom_input");


            var linkButton = document.createElement("BUTTON");
            var buttonElemType = elem_type.split("_")[0]+"_link";
            linkButton.classList.add("btn", "btn-icon", buttonElemType);

            linkButton.setAttribute("data-id", ''+specialId);
            linkButton.setAttribute("data-type", buttonElemType);

            linkButton.style.cssText = "border: 1px solid grey; border-radius: 5px; margin-left: 4px;";
            linkButton.id = buttonElemType + "_" + specialId;

            linkButton.innerHTML = '<i class="fas fa-link"></i>';


            linkButton.addEventListener("click", function(){
                openUrlModel(this.id);
            })
            
            new_input.appendChild(titleInput);
            new_input.appendChild(linkButton);

            titleInput.addEventListener("input", function() {
                auto_input_remove_oninput(this);
            })

            if(elem_type.includes("tutorial")){

                var linkButton = document.createElement("BUTTON");
                var buttonElemType = elem_type.split("_")[0]+"_up";
                linkButton.classList.add("btn", "btn-icon", buttonElemType);
    
                linkButton.setAttribute("data-id", ''+specialId);
                linkButton.setAttribute("data-type", buttonElemType);
    
                linkButton.style.cssText = "border: 1px solid grey; border-radius: 5px; margin-left: 22px;";
                linkButton.id = buttonElemType + "_" + specialId;
    
                linkButton.innerHTML = '<i class="fas fa-chevron-up"></i>';

                new_input.appendChild(linkButton);

                linkButton = document.createElement("BUTTON");
                var buttonElemType = elem_type.split("_")[0]+"_down";
                linkButton.classList.add("btn", "btn-icon", buttonElemType);
    
                linkButton.setAttribute("data-id", ''+specialId);
                linkButton.setAttribute("data-type", buttonElemType);
    
                linkButton.style.cssText = "border: 1px solid grey; border-radius: 5px; margin-left: 8px;";
                linkButton.id = buttonElemType + "_" + specialId;
    
                linkButton.innerHTML = '<i class="fas fa-chevron-down"></i>';

                new_input.appendChild(linkButton);
            }

            insertAfter(new_input, input.parentNode);
            
            //remove bottom_input class
            input.classList.remove("bottom_input");
        }
    }
}





function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}


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


// Helper Functions -----------------------------------------------------------

function commandToDB(query){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "https://selfstudywiki.speedstor.net/secure/command.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        "query": query,
        "secret4356": "not needed"
    }));
}

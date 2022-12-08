
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



// Helper Functions -----------------------------------------------------------

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
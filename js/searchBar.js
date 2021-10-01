window.onload = () => {
    document.getElementById("mainSearch").addEventListener("input", function(e){ 
        if(this.value != ""){
            document.getElementById("clearSearchInput").style.display = "block";
        }else{
            document.getElementById("clearSearchInput").style.display = "none";
        }
        //TODO: add suggestions
    });
    document.getElementById("mainSearch").addEventListener("keydown", function(e){
        if(e.key == "Enter"){
            redirectSearch();
        }
    })
}

function redirectSearch(){
    if(document.getElementById('mainSearch').value != "") 
        window.location.href='http://selfstudywiki.com/search.php?q='+document.getElementById('mainSearch').value;
}
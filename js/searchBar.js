window.addEventListener("load", () => {
    console.log("searchBar loaded");
    document.getElementById("mainSearch").addEventListener("input", function(e){ 
        console.log("heh");
        if(this.value != ""){
            document.getElementById("clearSearchInput").style.display = "block";
        }else{
            document.getElementById("clearSearchInput").style.display = "none";
        }
        //TODO: add suggestions
    });
    document.getElementById("mainSearch").addEventListener("keydown", function(e){
        console.log("heh");
        if(e.key == "Enter"){
            redirectSearch();
        }
    })

    document.getElementById("clearSearchInput").addEventListener("click", function(e){
        document.getElementById("mainSearch").value = "";
        document.getElementById("clearSearchInput").style.display = "none";
    })
}, true);

function redirectSearch(){
    if(document.getElementById('mainSearch').value != "") 
        window.location.href='http://selfstudywiki.com/search.php?q='+document.getElementById('mainSearch').value;
}

var test = "here";
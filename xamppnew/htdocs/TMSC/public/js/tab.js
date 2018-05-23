
    function changeColor(id) {
        var tabs = document.getElementsByClassName('tab')
        for (var i = 0; i < tabs.length; ++i) {
            var item = tabs[i];
            item.style.backgroundColor = (item.id == id) ? "#84d6ec" : "#fff";
        }
    }

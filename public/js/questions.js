var curTab = 0;

openSection(curTab);

function openSection(n) {
    var x = document.getElementsByClassName('tab-step');
    x[curTab].style.display = 'none';
    curTab = n;
    if (curTab >= x.length) return false;
    
    var x = document.getElementsByClassName('tab-step');
    x[curTab].style.display = 'block';

    var x = document.getElementsByClassName('step');
    for (var i = 0; i < x.length; i++)
        x[i].className = x[i].className.replace(' active', '');
    x[curTab].className += ' active';
}

function openTab(evt, qst) {
    // Get the element with id=qst
    var element = document.getElementById(qst);
    
    // Get all brother elements and hide them
    var tabcontent = element.parentElement.children;
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = 'none';
    }
  
    // Get all uncle elements with class='tablinks' and remove the class 'active'
    var tablinks = element.parentElement.parentElement.getElementsByClassName('tablinks');
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(' active', '');
    }
  
    // Show the current tab, and add an 'active' class to the button that opened the tab
    element.style.display = 'block';
    evt.currentTarget.className += ' active';
}
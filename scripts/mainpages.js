window.onresize = function() {
    if (window.innerWidth >= 1200) {
      document.getElementById("sidenav-main").style.width = "250px";
      document.getElementById("sidenav-main").style.display = "block";
      document.getElementById("main-content").style.marginLeft = "220px";
    } else {
    document.getElementById("sidenav-main").style.display = "none";
      document.getElementById("main-content").style.marginLeft= "0";
    }
  }
  function changeme(id) {
    var other = document.getElementById(id == 'first' ? 'second' : 'second');
    if (/s/i.test(other.innerHTML)) {
      other.innerHTML = other.innerHTML.replace('s', '-');
      document.getElementById("sidenav-main").style.width = "250px";
      document.getElementById("main-content").style.marginLeft = "220px";
    } else {
      other.innerHTML = other.innerHTML.replace('-', 's');
      document.getElementById("sidenav-main").style.width = "40px";
      document.getElementById("main-content").style.marginLeft= "0";
  
    }
  }
  
  function sidebar() {
    document.getElementById("sidenav-main").style.display = "block";
    document.getElementById("sidenav-main").style.width = "250px";
  }
  
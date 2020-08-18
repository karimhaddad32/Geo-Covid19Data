function expand() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav" || x.className === "topnav sticky") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }

  window.onscroll = function() {
    myFunction()
  };

  // Get the navbar
  var navbar = document.getElementById("myTopnav");

  // Get the offset position of the navbar
  var sticky = navbar.offsetTop;
  // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }

  navlinks = document.getElementsByTagName('a');
  
  for(var i = 0; i < navlinks.length - 1 ; i++){
    navlinks[i].onclick = function() {
    if(this.parentElement.classList.contains("responsive")){
      this.parentElement.classList.remove("responsive");
    }
  };
  }
 

  document.getElementById("hire_btn").onclick = function() {
    location.href = '#contact';
  };
  
  document.getElementById("portfolio_btn").onclick = function() {
    location.href = "#portfolio";
  };

function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);

  /* This creates the magnifier glass */
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");

  /* This allows for the magnifier glass to show */
  img.parentElement.insertBefore(glass, img);

  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;

  /* This is function when moving magnifier glass over image: */
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);

  /* This allows the magnifer to work for touch screens */
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);

  /* This is the function for moving the magnifier glass */
  function moveMagnifier(e) {
    var pos, x, y;

    /* This stops other things from happening when hovering*/
    e.preventDefault();

    /* This gets your mouse cursors x and y position: */
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;

    /* This checks if the cursor is on the image or outside */
    if (x < 0 || x > img.width || y < 0 || y > img.height) {
      /* Hide the magnifier if the cursor is outside the image */
      glass.style.display = "none";
      return;
    } else {
      /* This will show the magnifier if the cursor is on the image */
      glass.style.display = "block";
    }

    /* This prevents the magnifier glass from being positioned outside the image: */
    if (x > img.width - (w / zoom)) {
      x = img.width - (w / zoom);
    }
    if (x < w / zoom) {
      x = w / zoom;
    }
    if (y > img.height - (h / zoom)) {
      y = img.height - (h / zoom);
    }
    if (y < h / zoom) {
      y = h / zoom;
    }

    /* Sets the position of the magnifier glass: */
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";

    /* This displays what the magnifier glass sees */
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }

  function getCursorPos(e) {
    var a, x = 0,
      y = 0;
    e = e || window.event;
    /* Get x and y positions of image: */
    a = img.getBoundingClientRect();
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {
      x: x,
      y: y
    };
  }
}

/* Execute magnify function: */
magnify("product-image", 3); /* Strength of the magnifier glass */
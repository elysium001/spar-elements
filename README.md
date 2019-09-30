# Spar Elements: WordPress Plugin
Contact: webtechgnosis.com/spar, twitter: a.omarserrano
Another Wordpress plugin which provides shortcodes for common libraries and elements such as bootstrap v4 and Owl Carousel v2.3.4.

## Easy Install
Download and unzip into your wordpress plugin folder and activate!

## How to use shortcodes
Paste in any of the following shortcodes into a WordPress page or post and then hit save. 

### Owl Carousel 
shortcode: `[spar-owl][/spar-owl]`

options:
* loop=true
* lazyLoad= false
* xs="items:1,nav:true"
* sm="items:1,nav:true"
* md="items:3,nav:true"
* lg="items:4,nav:true"
* xl="items:5,nav:true"
* nav=true
* center= false
* autoWidth=false
* autoplay= false
* autoplayTimeout= 3500
* autoplayHoverPause= true
* margin=10
* autoHeight=false

To create a carousel, wrap the text/images/html that you would like to use as carousel items like this (hit return after each item):

example:
```
[spar-owl loop=true lg="items:5,nav:false"]

Some chunk of text/html/or an image.

Another chunk of stuff...

So on...

and so on...

[/spar-owl]
```

### Bootstrap 4
shortcode: `[spar-bootstrap][/spar-bootstrap]`

options:
* type = tabs, accordion, carousel, and modal

Modal options:
* title = Title for Modal link btn.
* btn_class = can be any bootstrap class besides 'btn-primary'
* btn_text = Button text
* modal = 'v-centered:false,fade:true,size:lg,backdrop:true,keyboard:true,focus:true,show:true'

Carousel options:
* carousel = 'controls:true,indicators:true,captions:true,interval:5000,keyboard:true,pause:hover,ride:carousel,wrap:true'

This shortcode should also wrap the desired content and declare an option like so:

Tabs
```
[spar-bootstrap type="tabs" style="pill"]

Some H heading Goes Here (h1-h6)

Followed by any combonation of text and images.

Another H heading Here

Some More Text and/or images

[/spar-bootstrap]
```

Accordion
```
[spar-bootstrap type="accordion"]

Some H heading Goes Here (h1-h6)

Followed by any combonation of text and images.

Another H heading Here

Some More Text and/or images

[/spar-bootstrap]
```


Bootstrap Carousel
```
[spar-bootstrap type="carousel"]

Some chunk of text/html/or an image. (followed by newline)

Another chunk of stuff...

So on...

and so on...

[/spar-bootstrap]
```

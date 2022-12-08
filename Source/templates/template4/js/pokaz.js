/*
	SimpleSlide v 1.1
	Developed by Gravita, www.gravita.se
		Thanks to Tom alias telefunken for a fix.
	
	License:
		MIT-style license
		
	//  Modyficate: joomla-best.com - 03.2008
	//  Website: 	http://www.joomla-best.com
	
	Class: 
		SimpleSlide
		
	Description:
		A slideshow class built to provide a simple way to create manual or automated slideshows.
	
	Arguments:
		container - a container to hodl the slideshow
		options - the options
		
	Options:
		type - "scroll/fade/scrollfade", Three differnt effects.
		direction - "forward/back", Defines the slide direction.
		goTo - number, Go to a specific slide.
		duration - miliseconds, Duration of the slide effect.
		auto - "loop/once", Makes the slide automated.
		time - miliseconds, Defines the amount of time an automated slide will stop at each element.
		
	Example:
		XHTML:
			<div id='SimpleSlide' class='SimpleSlide'>
				<div>
					<div>
						<!-- Put whatever you wish in here. -->
					</div>
					<div>
						<!-- Put whatever you wish in here. -->
					</div>
					<div>
						<!-- Put whatever you wish in here. -->
					</div>
				</div>
			</div>
		
		CSS:
			.SimpleSlide {
				width: 400px; Defining slideshow width 
				height: 100px; Defining slideshow height 
				overflow: hidden; required to hide not active elements. 
			}
			.SimpleSlide div {
				width: 2403px; Defining inner box with, must be SimpleSlide item x number of items + 3 pixels
			}
			.SimpleSlide div div {
				width: 400px;
				height: 100px;
				float: left; Required if you want a horizontal slide.
			}
		
		JavaScript:
			new SimpleSlide("SimpleSlide",{type: "scroll", direction: "forward", duration: 600});
*/


var SimpleSlide = new Class({
//	initialize: function(container,options) {
//		this.container = container;
//		this.options = options;
//		//	Is it on autorun or manual?
//		if(this.options.auto == "loop" || this.options.auto == "once") {
//			var automated;
//			this.automated = this.slider.periodical(this.options.time,this,$(this.container));
//		} else {
//			this.slider($(this.container))
//		}
//	},
	
	
	
	initialize: function(container,options) {
		this.container = container;
		this.options = options;
		var automated;
        var direction;

		if(this.options) this.direction = this.options.direction;
		else this.direction = "forward";

		//	Is it on autorun or manual?
		if (this.direction!="stop")
		{
		if(this.options.auto == "loop" || this.options.auto == "once") {

	 	   this.automated = this.slider.periodical(this.options.time,this,$(this.container));
		} else {
			this.slider($(this.container))
		}
        }
	},
	
	
	
	slider: function(container) {
		
		if(this.options.goTo) {
			var goTo = this.options.goTo.toInt();
				goTo -= 1;
		}
		
		if ((this.options.auto == "once" || this.options.auto == "loop") && this.direction == "stop")
		{
		   $clear(this.automated);
		}else{
		
		var child;
		
		
		
		// Get all child nodes to scroll between.
		var children = container.getChildren().getChildren()[0];
		// Run through all child nodes to see if there is a tagged one.
		children.each(function(e) {
			// If there is, make it current child.
			if(e.id == "currentChild") {
				child = e;
			}
           // alert(e.id);
		});
		//alert(this.direction);
		
		if(goTo || goTo == 0) {
			
			
			if(container.getChildren()[0].getChildren()[goTo]) { 
			child = container.getChildren()[0].getChildren()[goTo];
			$clear(this.automated);
			}
			
			else alert("Slide "+goTo+" does not exist");
		} else {
		
			if(!child && (this.direction == "forward" || this.direction == "stop")) {
				// If there isn't, make the first one current child.
				if(this.direction == "forward") {
					child = children[0].getNext();
					//child.id = "currentChild";
					
				}
				else if(this.direction == "back") {
					child = container.getChildren()[0].getLast();
				}
			} else {
			// Are we going to the next or previous node?
				if(this.direction == "forward") {
					var lastElement = container.getChildren()[0].getLast();
					// Stops the loop at the last element.
					if(lastElement == child.getNext() && this.options.auto == "once") $clear(this.automated);
					// Is the current child the last node? Then set the first node as child, otherwise set the next node as child.
					if(lastElement == child) child = children[0];
					else child = child.getNext();
				}
				else if(this.direction == "back") {
					var firstElement = container.getChildren()[0].getFirst();
					// Stops the loop at the last element.
					if(firstElement == child.getPrevious() && this.options.auto == "once") $clear(this.automated);
					// Is the current child the last node? Then set the first node as child, otherwise set the next node as child.
					if(firstElement == child) child = container.getChildren()[0].getLast();
					else child = child.getPrevious();			
				}
			
			}
		}
		// Is the child defined?
		if(child && this.direction != "stop") {
			// Which type of slider is defined?
			if(this.options.type == "scroll") this.scroll(container,children,child);
			else if(this.options.type == "fade") this.fade(container,children,child);
			else if(this.options.type == "scrollfade") this.scrollfade(container,children,child);
		}
		}
	},
		
		
		
//		if(!child && (this.direction == "forward" || this.direction == "stop")) {
//			// If there isn't, make the first one current child.
//			child = children[0].getNext();
//			child.id = "currentChild";
//		} else {
//			// Are we going to the next or previous node?
//			if(this.direction == "forward") {
//				var lastElement = container.getChildren()[0].getLast();
//				// Stops the loop at the last element.
//				if(lastElement == child.getNext() && this.options.auto == "once") $clear(this.automated);
//				// Is the current child the last node? Then set the first node as child, otherwise set the next node as child.
//				if(lastElement == child) child = children[0];
//				else child = child.getNext();
//			}
//			else if(this.direction == "back") child = child.getPrevious();
//		}
//		// Is the child defined?
//		if(child && this.direction != "stop") {
//			// Which type of slider is defined?
//			if(this.options.type == "scroll") this.scroll(container,children,child);
//			else if(this.options.type == "fade") this.fade(container,children,child);
//			else if(this.options.type == "scrollfade") this.scrollfade(container,children,child);
//		}
//		}
//		}
//	},
	
	
	
	stop: function() {
              this.direction="stop";
              this.slider($(this.container));
    	},
	start: function() {
		   this.direction="forward";
	 	   this.automated = this.slider.periodical(this.options.time,this,$(this.container));
                             },
	
	
	slider2: function(container) {
		var direction;
		if(this.options) direction = this.options.direction;
		else direction = "forward";
		var child;
		if(this.options.goTo) {
			var goTo = this.options.goTo.toInt();
				goTo -= 1;
		}
		// Get all child nodes to scroll between.
		var children = container.getChildren().getChildren()[0];
		// Run through all child nodes to see if there is a tagged one.
		children.each(function(e) {
			// If there is, make it current child.
			if(e.id == "currentChild") {
				child = e;
			}
		});
		if(goTo || goTo == 0) {
			if(container.getChildren()[0].getChildren()[goTo]) child = container.getChildren()[0].getChildren()[goTo];
			else alert("Slide "+goTo+" does not exist");
		} else {
			if(!child) {
				// If there isn't, make the first one current child.
				if(direction == "forward") {
					child = children[0].getNext();
				}
				else if(direction == "back") {
					child = container.getChildren()[0].getLast();
				}
			} else {
			// Are we going to the next or previous node?
				if(direction == "forward") {
					var lastElement = container.getChildren()[0].getLast();
					// Stops the loop at the last element.
					if(lastElement == child.getNext() && this.options.auto == "once") $clear(this.automated);
					// Is the current child the last node? Then set the first node as child, otherwise set the next node as child.
					if(lastElement == child) child = children[0];
					else child = child.getNext();
				}
				else if(direction == "back") {
					var firstElement = container.getChildren()[0].getFirst();
					// Stops the loop at the last element.
					if(firstElement == child.getPrevious() && this.options.auto == "once") $clear(this.automated);
					// Is the current child the last node? Then set the first node as child, otherwise set the next node as child.
					if(firstElement == child) child = container.getChildren()[0].getLast();
					else child = child.getPrevious();			
				}
			
			}
		}
		// Is the child defined?
		if(child) {
			// Which type of slider is defined?
			if(this.options.type == "scroll") this.scroll(container,children,child);
			else if(this.options.type == "fade") this.fade(container,children,child);
			else if(this.options.type == "scrollfade") this.scrollfade(container,children,child);
		}
	},
	scroll: function(container,children,child) {
		// Make it a scroll slide.
		var scroll = new Fx.Scroll(container,{duration: this.options.duration, onComplete: function() {
			// Remove tags from all child nodes.
			children.each(function(e) {
				e.id = "";
			});
			// Tag this child as current
			child.id = "currentChild";
		}}).toElement(child);
		
	},
	fade: function(container,children,child) {
		// Make it a fade slide
		var fade = new Fx.Style(container,'opacity',{duration: this.options.duration, onComplete: function() {
			new Fx.Scroll(container,{duration: 1,onComplete: function() {
				// Remove tags from all child nodes.
				children.each(function(e) {
					e.id = "";
				});
				// Tag this child as current
				child.id = "currentChild";
				new Fx.Style(container,'opacity').start(0.01,1);
			}}).toElement(child);
		}})
		fade.start(1,0.01);
	},
	scrollfade: function(container,children,child) {
		// In case you input the miliseconds as a string instead of integer.
		var durationInt = this.options.duration.toInt();
		// Make it a scrollfade slide
		var fade = new Fx.Style(container,'opacity',{duration: (durationInt/2)})
		fade.start(1,0.01).chain(function() {
			fade.start(0.01,1);
		});
		new Fx.Scroll(container,{duration: durationInt, onComplete: function() {
			// Remove tags from all child nodes.
			children.each(function(e) {
				e.id = "";
			});
			// Tag this child as current
			child.id = "currentChild";
		}}).toElement(child);
	}
});
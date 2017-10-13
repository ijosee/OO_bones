$(document).ready(function() {

	/*
	 * initialize the external events
	 * -----------------------------------------------------------------
	 */
	function init_events(ele) {
		ele.each(function() {

			// create an Event Object
			// (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title : $.trim($(this).text())
			// use the element's text as the event title
			}

			// store the Event Object in the DOM element so we can get to it
			// later
			$(this).data('eventObject', eventObject)

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex : 1070,
				revert : true, // will cause the event to go back to its
				revertDuration : 0
			// original position after the drag
			})

		})
	}

	init_events($('#external-events div.external-event'))

	initCalendar();

	/* ADDING EVENTS */
	var currColor = '#1c0dbc' // Red by default
	// Color chooser button
	var colorChooser = $('#color-chooser-btn')
	
	$(document).on("click", ".deleteEvenButton", function() {
		$(this).parent().parent().css('display','none');
		deleteCita($(this).attr("data-id"));
	});
	
	$(document).on("click", ".popover-title", function(){
		
		  var h3 = $(this)
		  var input = $('<input>').val(h3.text())

		  h3.after(input)
		  h3.hide()

		  input.on('blur', function(){
			  
		      h3.text(input.val());
		      h3.show();
		      input.hide();
		     
		  })
		  
		  updateCita
		  
	});
	
	$('#color-chooser > li > a').click(function(e) {
		e.preventDefault()
		// Save color
		currColor = $(this).css('color')
		// Add color effect to button
		$('#add-new-event').css({
			'background-color' : currColor,
			'border-color' : currColor
		})
	})
	
	$('#add-new-event').click(function(e) {
		
		e.preventDefault()
		
		// Get value and make sure it is not null
		var val = $('#new-event').val()
		if (val.length == 0) {
			return
		}

		// Create events
		var event = $('<div />')
		event.css({
			'background-color' : currColor,
			'border-color' : currColor,
			'color' : '#fff'
		}).addClass('external-event')
		
		event.html(val)
		
		$('#external-events').prepend(event)

		// Add draggable funtionality
		init_events(event)

		// Remove event from text input
		$('#new-event').val('')
		
	})
})

function initCalendar() {
	
	$.ajax({
		type : 'POST',
		url : '/OO_bones/admin/calendarcontroller/initCalendar',
		dataType : 'json',
		beforeSend: function(){
			// $('#box_body_mailchimp').append("<div class='overlay'><i
			// class='fa fa-refresh fa-spin'></i></div>");
		},
		success : function(result) {
			
			if(typeof(result.status) !== 'undefined' && result.status == 400){
				alert('No se ha podido inicializar el calendario : '+result.detail);
			}
			
 			var event_item = [];
 			
 			
			$(result).each(function(index,element){
				
				var event = {};
				
				event.title = element.value;
				event.start = element.date_in;
				event.end = element.date_out;
				event.allDay = false;
				event.backgroundColor = element.backgroundColor;
				event.borderColor = element.borderColor;
				event.id = element.id ;
				
				event_item.push(event);
				
			});
			
			$('#calendar').fullCalendar({
				header : {
					left : 'prev,next today',
					center : 'title',
					right : 'month,agendaWeek,agendaDay'
				},
				buttonText : {
					today : 'hoy',
					month : 'mes',
					week : 'semana',
					day : 'dia'
				},

				// Random default events
				events : event_item,
				defaultView : 'agendaWeek',
				editable : true,
				droppable : true, 
				loading: function (bool) {
				       //alert('events are being rendered'); // Add your script
															// to show loading
				    },
			    eventAfterAllRender: function (view) {
				        //alert('all events are rendered'); // remove your
															// loading
				    },
				drop : function(date, allDay ) { // this function is called
													// when

					// retrieve the dropped element's stored Event Object
					var eventObject = {} ;
					
					eventObject.event_id = this.id
					eventObject.event_title =  $(this).data('eventObject').title 
					eventObject.event_start_time = date.format()
					var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration')); 
				    var time_end = date.clone().add(defaultDuration)
				    eventObject.event_end_time =  time_end.format()
					eventObject.event_backgroundColor = $(this).css('background-color')
					eventObject.event_borderColor = $(this).css('border-color')

					// is the "remove after drop" checkbox checked?
					if ($('#drop-remove').is(':checked')) {
						// if so, remove the element from the "Draggable Events"
						// list
						$(this).remove()
					}
				    
					saveCita(eventObject);

// //Call when you drop any red/green/blue class to the week table.....first
// time runs only.....
// console.log("dropped");
// console.log(date.format());
// console.log(this.id);
// var defaultDuration = moment.duration($('#calendar').fullCalendar('option',
// 'defaultTimedEventDuration'));
// var end = date.clone().add(defaultDuration); // on drop we only have date
// given to us
// console.log('end is ' + end.format());

//
// // assign it the date that was reported
// copiedEventObject.start = date
// copiedEventObject.allDay = allDay
// copiedEventObject.finish = originalEventObject.end._i
					

					// $('#calendar').fullCalendar('renderEvent',
					// copiedEventObject, true)

				},
				eventClick: function(calEvent, jsEvent, view) {

					// $(this).popover({html:true,title:event.title,placement:'top',container:'body'}).popover('show');
// alert('Event: ' + calEvent.title);
// alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
// alert('View: ' + view.name);
//
// // change the border color just for fun
					// var a = "";

			    },
			    eventDrop: function(event, delta, revertFunc, jsEvent, ui, view ) {
			    	
			    		// retrieve the dropped element's stored Event Object
					var eventObject = {} ;
					
					eventObject.event_id = event.id
					eventObject.event_title =  event.title 
					eventObject.event_start_time = event.start.format()
					var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration')); 
				    var time_end = event.end || event.start.clone().add(defaultDuration);
					eventObject.event_end_time =  time_end.format()
					eventObject.event_backgroundColor = $(this).css('background-color')
					eventObject.event_borderColor = $(this).css('border-color')

			    		updateCita(eventObject) ;
			    	
			    	
// //inner column movement drop so get start and call the ajax function......
// console.log(event.start.format());
// console.log(event.id);
// var defaultDuration = moment.duration($('#calendar').fullCalendar('option',
// 'defaultTimedEventDuration')); // get the default and convert it to proper
// type
// var end = event.end || event.start.clone().add(defaultDuration); // If there
// is no end, compute it
// console.log('end is ' + end.format());

	            // alert(event.title + " was dropped on " +
				// event.start.format());
	            
		    		// getting time

			    },
			    eventResize: function(event, delta, revertFunc) {

				    	var event_id = event.id;
			    		var event_start_time = moment(event.start._i).format('YYYY-MM-DD hh:mm:ss');
			    		var event_end_time = moment(event.end._i).format('YYYY-MM-DD hh:mm:ss');
			    		
			    		updateCita(event_id,event_start_time,event_end_time);
			    },
			    eventRender: function (event, element) {
			    	
			        element.popover({
			        		html: true,
			            title: event.title,
			            trigger : 'click',
			            placement : 'auto',
			            content: 'Start: ' + moment(event.start._i).format('hh:mm:ss') + '<br> End: ' + moment(event.end._i).format('hh:mm:ss') + 
			            '<br> <button type="button" data-id='+event.id+' class="btn btn-block btn-danger btn-xs deleteEvenButton">Eliminar</button>'
			        });
			        
			       
			    }
			})
			
		},
		error : function(result){
			$('#main-box_body_mailchimp > .overlay').remove();
			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			// $('#box_body_mailchimp > .overlay').remove();
		}
	});
	
}
	
function updateCita(eventObject){
	
	$.ajax({
		
		type : 'POST',
		url : '/OO_bones/admin/calendarcontroller/updateCitaDrag',
		data: { eventId : eventObject.event_id, eventStart : eventObject.event_start_time , eventEnd : eventObject.event_end_time  },
		dataType : 'text',
		beforeSend: function(){
			
		},
		success : function(result) {
			
			if(result !== null &&typeof(result.status) !== 'undefined' && result.status == 400){
				alert('No se ha podido actualizar la cita : '+result.detail);
			}
			
			// alert('Cita ' + result + ' actualizada');
			console.log('Cita ' + result + ' actualizada');
			
		},
		error : function(result){
			
			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			// $('#box_body_mailchimp > .overlay').remove();
		}
	
		});
	
}

function saveCita(eventObject){
	
	$.ajax({
		
		type : 'POST',
		url : '/OO_bones/admin/calendarcontroller/saveCita',
		data: {eventValue : eventObject.event_title, eventStart : eventObject.event_start_time , eventEnd : eventObject.event_end_time , backgroundColor : eventObject.event_backgroundColor, borderColor: eventObject.event_borderColor  },
		dataType : 'text',
		beforeSend: function(){
			
		},
		success : function(result) {
			
			if(typeof(result.status) !== 'undefined' && result.status == 400){
				alert('No se ha podido actualizar la cita : '+result.detail);
			}
			
			// alert('cita guardada');
			console.log('Cita ' + result + ' guardada');
			
			$('#calendar').fullCalendar('destroy');
			initCalendar();
		},
		error : function(result){

			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			// $('#box_body_mailchimp > .overlay').remove();
		}
	
	});
	
}

function deleteCita(eventId){
	
	$.ajax({
		
		type : 'POST',
		url : '/OO_bones/admin/calendarcontroller/deleteCita',
		data: { eventId : eventId },
		dataType : 'text',
		beforeSend: function(){
			
		},
		success : function(result) {
			
			if(typeof(result.status) !== 'undefined' && result.status == 400){
				alert('No se ha podido actualizar la cita : '+result.detail);
			}
			
			// alert('cita guardada');
			console.log('Cita ' + result + ' eliminada');
			
			$('#calendar').fullCalendar('removeEvents', result);
		},
		error : function(result){

			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			// $('#box_body_mailchimp > .overlay').remove();
		}
	
	});
	
}



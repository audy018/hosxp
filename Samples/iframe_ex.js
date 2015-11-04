		var caldef1 = {
			firstday:0,     // First day of the week: 0 means Sunday, 1 means Monday, etc.
			dtype:'dd-MM-yyyy', // Output date format MM-month, dd-date, yyyy-year, HH-hours, mm-minutes, ss-seconds
			width:220,       // Width of the calendar table
			windoww:250,     // Width of the calendar window
			windowh:175,     // Height of the calendar window
			border_width:0,      // Border of the table
			border_color:'#0000d3',  // Color of the border
			dn_css:'clsDayName',     // CSS for week day names
			cd_css:'clsCurrentDay',     // CSS for current day
			tw_css:'clsCurrentWeek',  //  CSS for current week
			wd_css:'clsWorkDay',     // CSS for work days (this month)
			we_css:'clsWeekEnd',     // CSS for weekend days (this month)
			wdom_css:'clsWorkDayOtherMonth', // CSS for work days (other month)
			weom_css:'clsWeekEndOtherMonth', // CSS for weekend days (other month)
			headerstyle: {
				type:'buttons',         // Type of the header may be: 'buttons' or 'comboboxes'
				css:'clsDayName',       // CSS for header
				imgnextm:'img/arrow_right.gif', // Image for next month button. 
				imgprevm:'img/arrow_left.gif',    // Image for previous month button. 
				imgnexty:'img/arrow_right.gif', // Image for next year button. 
				imgprevy:'img/arrow_left.gif'     // Image for previous year button. 
			},
			monthnames :["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", 
                     "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", 
                     "พฤศจิกายน", "ธันวาคม"],
			daynames : ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."]

			// Array with month names
			//monthnames :["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			// Array with week day names
			//daynames : ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]

			
		};

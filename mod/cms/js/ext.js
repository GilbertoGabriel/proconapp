/**
 * Extras
 * 
 * @author Mario Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see https://wtag.com.br/getz
 */

/**
 * Graphic generator
 *
 * @param {String} id
 * @param {Array} lines
 * @param {Array} columns
 * @param {String} preValue
 * @param {String} posValue
 * @param {Boolean} convertToDecimal
 *
 * @example
 * graphic("@_DOCUMENTO_BY_ID", 
	[(Math.random() * 100).toFixed(2), (Math.random() * 100).toFixed(2), (Math.random() * 100).toFixed(2)], 
	["Jan", "Feb", "Mar"], "$");
 */	
function graphic(id, lines, columns, preValue, posValue, convertToDecimal, lineColor) {
	/*
	 * Set div width
	 */
	sA(gI(id + "l"), "style", "width: " + (columns.length * 64) + "px; margin: 0 auto;"); 
	sA(gI(id + "c"), "style", "width: " + (columns.length * 64) + "px; margin: 0 auto;");
	
	/*
	 * Set line items
	 */
	var lineItems = "";
	var mes = "";
	for (var i = 0; i < columns.length; i++) {
		if (columns[i].substr(2, 5) == "Jan") {
			mes = "01";
		} else if (columns[i].substr(3, 5) == "Fev") {
			mes = "02";
		} else if (columns[i].substr(3, 5) == "Mar") {
			mes = "03";
		} else if (columns[i].substr(3, 5) == "Abr") {
			mes = "04";
		} else if (columns[i].substr(3, 5) == "Mai") {
			mes = "05";
		} else if (columns[i].substr(3, 5) == "Jun") {
			mes = "06";
		} else if (columns[i].substr(3, 5) == "Jul") {
			mes = "07";
		} else if (columns[i].substr(3, 5) == "Ago") {
			mes = "08";
		} else if (columns[i].substr(3, 5) == "Set") {
			mes = "09";
		} else if (columns[i].substr(3, 5) == "Out") {
			mes = "10";
		} else if (columns[i].substr(3, 5) == "Nov") {
			mes = "11";
		} else if (columns[i].substr(3, 5) == "Dez") {
			mes = "12";
		}
		lineItems += "<p id=\"" + id + i + 
				"l\" class=\"dv-f-l dv-ta-c gz-bold\" style=\"width: 64px;\" onclick=\"goTo('/@_YOUR_SCREEN/called/" 
				+ mes + "987654321" + columns[i].substr(0, 2) + "/1/historyBack/0')\"></p>";
	}
	
	lineItems += "<div class=\"dv-clear\"></div>";
	
	sH(gI(id + "l"), lineItems);
	
	/*
	 * Set column items
	 */
	var columnItems = "";
	
	for (var i = 0; i < columns.length; i++) {
		columnItems += "<p id=\"" + id + i + "c\" class=\"dv-f-l dv-ta-c gz-bold\" style=\"width: 64px;\"></p>";
	}
	
	columnItems += "<div class=\"dv-clear\"></div>";
	
	sH(gI(id + "c"), columnItems);
	
	/*
	 * Canvas
	 */
	var canvas = document.getElementById(id);
	canvas.setAttribute("width", columns.length * 64);
	canvas.setAttribute("height", 100);
	
	/* 
	 * Mouse move
	 */
	canvas.addEventListener("mousemove", function(e) {
		var mousePos = getMousePosition(canvas, e);
		
		var j = 0;
		var k = 0;
		
		for (var i = 0; i < lines.length; i++) {
			sC(gI(id + i + "l"), "dv-f-l dv-ta-c gz-bold");
			sC(gI(id + i + "c"), "dv-f-l dv-ta-c gz-bold");
			
			j = k;
			k += 64;
			
			if (mousePos.x > j && mousePos.x < k) {
				sC(gI(id + i + "l"), "dv-f-l dv-ta-c gz-bold gz-green");
				sC(gI(id + i + "c"), "dv-f-l dv-ta-c gz-bold gz-green");
			}
		}	
	}, false);
	
	/* 
	 * Mouse out
	 */
	canvas.addEventListener("mouseout", function(e) {
		for (var i = 0; i < lines.length; i++) {
			sC(gI(id + i + "l"), "dv-f-l dv-ta-c gz-bold");
			sC(gI(id + i + "c"), "dv-f-l dv-ta-c gz-bold");
		}
	}, false);
	
	/* 
	 * Context
	 */
	var context = canvas.getContext("2d");
	context.fillStyle = "#fff";
	context.strokeStyle = lineColor;
	context.fillRect(0, 0, window.innerWidth, 100);

	// Range of pixels
	var range = 0;
	
	// Bigest value from line
	var valuesMax = Math.max.apply(Math, lines);
	
	/*
	 * Set line values
	 */
	for (var i = 0; i < lines.length; i++) {
		sH(gI(id + i + "l"), preValue + (convertToDecimal ? 
				toDecimal(lines[i]) : lines[i]) + posValue);
		
		lines[i] = (lines[i] * 100) / valuesMax;
	}
	
	/*
	 * Set column values
	 */
	for (var i = 0; i < columns.length; i++) {
		sH(gI(id + i + "c"), columns[i]);
	}
	
	// Interval
	var interval = setInterval(builder, 10);
	
	/*
	 * Builder
	 */
	function builder() {
		if (range > window.innerWidth)
			clearInterval(interval);
			
		var j = 0;

		for (var i = 0; i < lines.length; i++) {
			// 32, 96, 160, 224, 288, 352...
			j = (32 * (i + 1)) + (32 * i);
			
			if (range == j) {
				context.lineTo(range, 100 - lines[i]);
				context.stroke();
			}
		}
		
		// 8 pixels
		range += 8;
	}
	
	// context.fillStyle = "#616161";
	// context.fillRect (100, 50, 20, 20);
}

/**
 * Pizza generator
 *
 * @param {String} id
 */	
function pizza(id) {
	var data_table = gI(id + "t");
	var canvas = gI(id);
	
	// Which TD contains the data
	var td_index = 1;

	// Get the data[] from the table
	var tds, data = [], color, colors = [], value = 0, total = 0;
	
	// All TRs
	var trs = data_table.getElementsByTagName("tr");
	
	for (var i = 0; i < trs.length; i++) {
		// All TRs
		tds = trs[i].getElementsByTagName("td");

		if (tds.length === 0) continue; //  no TDs here, move on

		// get the value, update total
		value = parseFloat(tds[td_index].innerHTML);
		data[data.length] = value;
		total += value;

		// random color
		if (id == "idade") {
			color = getColorIdade(i);
		} else {
			color = getColor(i);
		}
		colors[colors.length] = color; // save for later
		// trs[i].style.backgroundColor = color; // color this TR
	}

	// exit if canvas is not supported
	if (typeof canvas.getContext === "undefined") { return; }

	// get canvas context, determine radius and center
	var ctx = canvas.getContext("2d");
	var canvas_size = [canvas.width, canvas.height];
	var radius = Math.min(canvas_size[0], canvas_size[1]) / 2;
	var center = [canvas_size[0]/2, canvas_size[1]/2];

	var sofar = 0; // keep track of progress
	
	// loop the data[]
	for (var piece in data) {
		var thisvalue = data[piece] / total;

		ctx.beginPath();
		ctx.moveTo(center[0], center[1]); // center of the pie
		ctx.arc(  // draw next arc
			center[0],
			center[1],
			radius,
			Math.PI * (- 0.5 + 2 * sofar), // -0.5 sets set the start to be top
			Math.PI * (- 0.5 + 2 * (sofar + thisvalue)),
			false
		);

		ctx.lineTo(center[0], center[1]); // line back to the center
		ctx.closePath();
		ctx.fillStyle = colors[piece];    // color
		ctx.fill();

		sofar += thisvalue; // increment progress tracker
	}

	///// DONE!

	/*
	var mudarCor = document.getElementById("muda-cor"); 
	mudarCor.onclick = function() {
		window.location.reload();
	}
	*/	
}

// utility - generates random color
function getColor(position) {
	if (position == 1)
		return "#80cbc4";
	else if (position == 2)	 
		return "#ef9a9a";		
	else if (position == 3)
		return "#fff59d"; 
	else if (position == 4)
		return "#ffcc80";
	else if (position == 5) 
		return "#ef9a9a";
	else if (position == 6)	 
		return "#eeeeee";
	else
		return "#90caf9";
		
	/*
	var rgb = [];
	
	for (var i = 0; i < 3; i++) {
		rgb[i] = Math.round(100 * Math.random() + 155) ; // [155-255] = lighter colors
	}

	return "rgb(" + rgb.join(",") + ")";
	*/
}
function getColorIdade(position) {
	if (position == 1)
		return "#80cbc4";
	else if (position == 2)	 
		return "#80cbc4";		
	else if (position == 3)
		return "#80cbc4"; 
	else if (position == 4)
		return "#81D4FA";
	else if (position == 5) 
		return "#81D4FA";
	else if (position == 6)	 
		return "#ffcc80";
	else if (position == 7)	 
		return "#ffcc80";
	else if (position == 8)	 
		return "#ef9a9a";
	else if (position == 9)	 
		return "#ef9a9a";
	else
		return "#ef9a9a";
		
	/*
	var rgb = [];
	
	for (var i = 0; i < 3; i++) {
		rgb[i] = Math.round(100 * Math.random() + 155) ; // [155-255] = lighter colors
	}

	return "rgb(" + rgb.join(",") + ")";
	*/
}

/**
 * Get mouse position
 *
 * @param {Object} canvas
 * @param {Event} e
 */	
function getMousePosition(canvas, e) {
	var rect = canvas.getBoundingClientRect();
	
	return {
		x: e.clientX - rect.left,
		y: e.clientY - rect.top
	};
}

/**
 * Decimal converter
 *
 * @param {Double} value
 */
function toDecimal(value) {
	var mask = "";
	
	var metadata = value.replace(/\,/g, "").replace(/\./g, "");	
	
	if (metadata.charAt(0) == "0" && metadata.charAt(1) == "0")
		metadata = metadata.replace("00", "");
	else if (metadata.charAt(0) == "0")
		metadata = metadata.replace("0", "");

	if (gL(metadata) == 1)
		mask = "0,0" + metadata;
	else if (gL(metadata) == 2)
		mask = "0," + metadata;
	else if (gL(metadata) == 3) 
		mask = metadata.charAt(0) + "," + metadata.charAt(1) + 
				metadata.charAt(2);
	else if (gL(metadata) > 3) {
		var number = metadata.substring(0, (gL(metadata) - 2));
		var decimal = metadata.substring((gL(metadata) - 2), gL(metadata));
		
		var position = 0;
		
		for (var i = (gL(number) - 1); i >= 0; i--) {
			if (position == 3) {
				position = 0;
				
				mask = number.charAt(i) + "." + mask;
			} else 
				mask = number.charAt(i) + mask

			position++;
		}
		
		mask = mask + "," + decimal;
	}
	
	return mask;
}

/**
 * Remover foto.
 *
function removerFoto() {
	request("remover_foto", "update");
} */

/**
 * Relatório com filtro.
 *
function relatorios() {
	if (validate()){
		var filter = gI("@_YOUR_ID").value;
		goToBlank("/../relatorios/" + filter + "/1");
	}
} */

/**
 * Relatório com filtro de data de início e fim.
 *
function relatoriosDate() {
	if (validate()){
		var filter = gI("@_YOUR_ID").value;
		var data_inicio = "";
		if (gI("@_YOUR_DATE_BEGIN").value != "") {
			var data_inicioArr = (gI("@_YOUR_DATE_BEGIN").value.split("/"));
			data_inicio = data_inicioArr[0] + "999999999" + data_inicioArr[1] + "999999999" +
					data_inicioArr[2];
		}
		filter += "987654321" + data_inicio;
		var data_conclusao = "";
		if (gI("@_YOUR_DATE_END").value != "") {
			var data_conclusaoArr = (gI("@_YOUR_DATE_END").value.split("/"));
			data_conclusao = data_conclusaoArr[0] + "999999999" + data_conclusaoArr[1] + 
					"999999999" + data_conclusaoArr[2];
		}
		filter += "987654321" + data_conclusao;
		goToBlank("/../relatorios/" + filter + "/1");
	}
} */

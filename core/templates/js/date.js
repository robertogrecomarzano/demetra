function keyCheck(eventObj, obj, filter) {
	var keyCode;
	if (!eventObj)
		eventObj = window.event;
	if (document.all)
		keyCode = eventObj.keyCode;
	else
		keyCode = eventObj.which;
	// var str = obj.value;
	var bNumericKey = keyCode > 47 && keyCode < 58;
	var bNumericPad = keyCode > 95 && keyCode < 106;
	var bNum = bNumericKey || bNumericPad;
	var bBackSpace = keyCode == 8;
	var bTab = keyCode == 9;
	var bEnter = keyCode == 13;
	var bAllowed = bBackSpace || bTab || bEnter;
	switch (filter) {
		case "num":
			return bAllowed || bNum;
			break;
		case "data":
			obj.onkeyup = function() {
				dataFormat(this);
			};
			obj.onblur = function() {
				dataCheck(this);
			};
			return bAllowed || bNum;
			break;
		default:
			return false;
	}
}

function dataCheck(obj) {
	var good = true;
	var valore = $(obj).val();

	if (valore == "" || valore == undefined)
		return good;

	var s = extractNums(valore);
	var d = s.substring(0, 2);
	var m = s.substring(2, 4);
	var y = s.substring(4);
	var s2 = d + "/" + m + "/" + y;
	if (s2 != valore || s.length != 8) {
		bootbox.alert(_e("Attenzione! La data") + " " + valore + " "
			+ _e("è in formato non corretto (gg/mm/aaaa)!"));
		good = false;
	} else if (d < 1 || d > 31 || m < 1 || m > 12 || y < 1900 || y > 2100) {
		bootbox.alert(_e("Attenzione! Valori non permessi nella data") + " " + valore
			+ ".");
		good = false;
	}
	var color = good ? "green" : "red";
	$(obj).attr("style", "color:" + color);
	/*
	 * if (!good) $(obj).val("");
	 */
	return good;
}

function dataFormat(obj) {
	var v = obj.value;
	if (v.length > 2 && v.length <= 5) {
		if (v.length == 3 && v.charAt(2) == '/')
			obj.value = v.substring(0, 2);
		else {
			var s = extractNums(obj.value);
			var s2 = s.substring(0, 2) + "/" + s.substring(2);
			obj.value = s2;
		}
	}
	if (v.length > 5) {
		if (v.length == 6 && v.charAt(5) == '/')
			obj.value = v.substring(0, 5);
		else {
			var s = extractNums(v);
			var s2 = s.substring(0, 2) + "/" + s.substring(2, 4) + "/"
				+ s.substring(4, 8);
			obj.value = s2;
		}
	}
}

function extractNums(str) {
	var o = "";
	for (var i = 0; i < str.length; i++)
		if ("0123456789".indexOf(str.charAt(i)) > -1)
			o += str.charAt(i);
	return o;
}
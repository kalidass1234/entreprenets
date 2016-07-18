/*
Negative / 3 decimal places
onblur="extractNumber(this,3,true);" onkeyup="extractNumber(this,3,true);" onkeypress="return blockNonNumbers(this, event, true, true);"

No negative / 2 decimal places
onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);" onkeypress="return blockNonNumbers(this, event, true, false);"


Negative / No decimal places
onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, false, true);"


No negative / No decimal places
onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);" onkeypress="return blockNonNumbers(this, event, false, false);"


No negative / Unlimited decimal places
onblur="extractNumber(this,-1,false);" onkeyup="extractNumber(this,-1,false);" onkeypress="return blockNonNumbers(this, event, true, false);" 
*/

/*No Special Charactor or Number In Name
onblur="extractspecialchar(this,event);" onkeyup="extractspecialchar(this,event);" onkeypress="return blockspecialchar(this, event);" 
*/
function extractNumber(obj, decimalPlaces, allowNegative)
{
	var temp = obj.value;
	
	// avoid changing things if already formatted correctly
	var reg0Str = '[0-9]*';
	if (decimalPlaces > 0) 
	{
		reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
	}
	 else if (decimalPlaces < 0) 
	{
		reg0Str += '\\.?[0-9]*';
	}
	reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
	reg0Str = reg0Str + '$';
	var reg0 = new RegExp(reg0Str);
	if (reg0.test(temp)) return true;
	
	// first replace all non numbers
	var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
	var reg1 = new RegExp(reg1Str, 'g');
	temp = temp.replace(reg1, '');

	if (allowNegative) {
		// replace extra negative
		var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
		var reg2 = /-/g;
		temp = temp.replace(reg2, '');   alert(temp);
		if (hasNegative) temp = '-' + temp;
	}
	
	if (decimalPlaces != 0) {
		var reg3 = /\./g;
		var reg3Array = reg3.exec(temp);
		if (reg3Array != null) {
			// keep only first occurrence of .
			//  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
			var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
			reg3Right = reg3Right.replace(reg3, '');
			reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
			temp = temp.substring(0,reg3Array.index) + '.' + reg3Right; 
		}
	}
	
	obj.value = temp;
}
function blockNonNumbers(obj, e, allowDecimal, allowNegative)
{
	var key;
	var isCtrl = false;
	var keychar;
	var reg;
		
	if(window.event) {
		key = e.keyCode;
		isCtrl = window.event.ctrlKey;
		
	}
	else if(e.which) {
		key = e.which;
		isCtrl = e.ctrlKey;
		
	}
	
	if (isNaN(key)) return true;
	
	
	
	keychar = String.fromCharCode(key);
	

	// check for backspace or delete, or if Ctrl was pressed
	if (key == 8 || isCtrl)
	{
		return true;
	}
	

	reg = /\d/;
	var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
	var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;
	if(reg.test(keychar) ==false)
	{
		//alert("Only Numeric Value Allow.");
	}
		
		
	return isFirstN || isFirstD || reg.test(keychar);
}

function blockspecialchar(obj,e)
{
	//alert(obj.value+'=='+e.keyCode+'=='+e.charCode);
	var allow;
	
	if(e.charCode == 95) {
           //the key was A-Z
		   allow=true;
		   //return true;
        }
		if(e.charCode == 46) {
           //the key was A-Z
		   allow=true;
		   //return true;
        }
	if(e.charCode >= 44 && e.charCode <= 45) {
           //the key was A-Z
		   allow=true;
		   //return true;
        }
	if(e.charCode >= 48 && e.charCode <= 57) {
           //the key was A-Z
		   allow=true;
		   //return true;
        }
	if(e.charCode >= 65 && e.charCode <= 90) {
           //the key was A-Z
		   allow=true;
		   //return true;
        }
        if(e.charCode >= 97 && e.charCode <= 122) {
           //the key was a-z
		   allow=true;
		   //return true;
        }
		if(e.keyCode>=8 && e.keyCode<=9)
		{
			allow=true;
			//return true;
		}
		if(e.charCode==32)
		{
			allow=true;
			//return true;
		}
		if(allow==true)
		{
		return true;
		}
		else
		{
		//obj.value = obj.value.replace(obj.value,'');
		return false;
		}
}

function extractspecialchar(obj,e)
{
	//alert(obj.value+'=='+e.keyCode+'=='+e.charCode);
	var allow=true;
	var inputVal = obj.value;
	
    var characterReg = /^\s*[a-zA-Z0-9+-_,\s]+\s*$/;
    if(!characterReg.test(inputVal)) {
        //alert("No special characters allowed");
		allow=false;
    }
		if(allow==true)
		{
		return true;
		}
		else
		{
		obj.value = obj.value.replace(obj.value,'');
		return false;
		}
}
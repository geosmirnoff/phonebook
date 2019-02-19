function testAjax() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
		{
			document.getElementById('mega').style.visibility = "visible";	
			document.getElementById('mega').innerHTML = this.responseText;
			document.getElementById('show').style.display = "none";
			document.getElementById('hide').style.display = "inline";
		}
	};
	xhttp.open('GET', 'menu.php', true);
	xhttp.send();
}

document.getElementById('show').onclick = function() {
	testAjax();
}

document.getElementById('hide').onclick = function() {
	document.getElementById('mega').style.visibility = "hidden";
	document.getElementById('show').style.display = "inline";
	document.getElementById('hide').style.display = "none";
}

function stroka() {
	var str = decodeURI(window.location.href);
	    
	/*if ((str.indexOf("index.php") + 1))
	{
		document.getElementById('pdf').onclick = function() {
			alert('Для распечатки PDF выберите нужное подразделение в меню "Структура"');
		}
	}
	if (str.indexOf("search.php") + 1)
	{
		document.getElementById('pdf').onclick = function() {
				alert('Для распечатки PDF выберите нужное подразделение в меню "Структура"');
		}
	}
	if (str.indexOf("table.php") + 1)
	{
		document.getElementById('pdf').onclick = function() {
			document.getElementById('form-table').submit();
		}
    }*/
}
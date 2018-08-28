function date_time(id){
	date = new Date;
	year = date.getFullYear();
	month = date.getMonth();
	months = new Array ('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık');
	d = date.getDate();
	day = date.getDay();
	days = new Array ('Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi');
	
	h = date.getHours();
	if(h<10){ h = "0"+h; }
	m = date.getMinutes();
	if(m<10){ m = "0"+m; }
	s = date.getSeconds();
	if(s<10){ s = "0"+s; }

	result = d+' '+months[month]+' '+days[day]+' '+year+' - '+h+':'+m;
	document.getElementById(id).innerHTML = result;
	setTimeout('date_time("'+id+'")','1000');
	
	return true;
}
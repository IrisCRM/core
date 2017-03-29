// Format: 31.12.2000 23:00
// miv, совместно с format_italian.js и format_american.js

Date.prototype.toFormattedString = function(include_time) {
  str = Date.padded2(this.getDate()) + '.' + Date.padded2(this.getMonth() + 1) + '.' + this.getFullYear();
  if (include_time) {
    if (this.getHours() <= 9)
	  l_hours = '0' + this.getHours();
    else
	  l_hours = this.getHours();
  str += " " + l_hours + ":" + this.getPaddedMinutes();
  }
  return str;	
}

Date.parseFormattedString = function (string) {
	var regexp = '([0-9]{1,2}).(([0-9]{1,2}).(([0-9]{4})( ([0-9]{1,2}):([0-9]{2})? *)?)?)?';

	var d = string.match(new RegExp(regexp, "i"));
	if (d==null) return Date.parse(string); // at least give javascript a crack at it.
	var offset = 0;
	var date = new Date(d[5], 1, 1);
	if (d[3]) { date.setMonth(d[3] - 1); }
	if (d[5]) { date.setDate(d[1]); }
	if (d[7]) {
		date.setHours(parseInt(d[7], 10));    
	}
	if (d[8]) { date.setMinutes(d[8]); }
	if (d[10]) { date.setSeconds(d[10]); }
	return date;
}

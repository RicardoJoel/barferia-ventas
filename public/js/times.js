/**
 * Add two string time values (HH:mm:ss) with javascript
 *
 * Usage:
 *  > addTimes('04:20:10', '21:15:10');
 *  > "25:35:20"
 *  > addTimes('04:35:10', '21:35:10');
 *  > "26:10:20"
 *  > addTimes('30:59', '17:10');
 *  > "48:09:00"
 *  > addTimes('19:30:00', '00:30:00');
 *  > "20:00:00"
 *
 * @param {String} startTime  String time format
 * @param {String} endTime  String time format
 * @returns {String}
 */
 function addTimes (startTime, endTime) {
  var times = [ 0, 0, 0 ]
  var max = times.length

  var a = (startTime || '').split(':')
  var b = (endTime || '').split(':')

  // normalize time values
  for (var i = 0; i < max; i++) {
    a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
    b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
  }

  // store time values
  for (var i = 0; i < max; i++) {
    times[i] = a[i] + b[i]
  }

  var hours = times[0]
  var minutes = times[1]
  var seconds = times[2]

  if (seconds >= 60) {
    var m = (seconds / 60) << 0
    minutes += m
    seconds -= 60 * m
  }

  if (minutes >= 60) {
    var h = (minutes / 60) << 0
    hours += h
    minutes -= 60 * h
  }

  return hours + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2)
}

function convert(str){
  var hor = 0, min = 0;
  
  if ( typeof str === 'string' ) {
    if (str.indexOf('horas') > -1) str = str.split('horas');
    else if (str.indexOf('hora') > -1) str = str.split('hora');
    else if (str.indexOf(':') > -1) str = str.split(':');

    if (Array.isArray(str)) {
      hor = str[0].trim();
      str = str[1].trim();
    }
    else
      hor = str;
  }

  if ( typeof str === 'string' ) {
    if (str.indexOf('minutos') > -1) str = str.split('minutos');
    else if (str.indexOf('minuto') > -1) str = str.split('minuto');
    else if (str.indexOf(':') > -1) str = str.split(':');

    if (Array.isArray(str))
      min = str[0].trim();
    else
      min = str;
  }
  return hor + ':' + ('00' + min).substr(-2,2) + ':00';
}

function forHumans(str){
  var hor = 0, min = 0;
  if ( typeof str === 'string' ) {
    str = str.split(':');
    hor = parseInt(str[0]);
    min = parseInt(str[1]);
  }
  return (!hor ? '' : (hor + (hor > 1 ? ' horas ' : ' hora '))) + (!min ? '' : (min + (min > 1 ? ' minutos ' : ' minuto ')));
}
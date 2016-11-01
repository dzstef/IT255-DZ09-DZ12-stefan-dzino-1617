import {Pipe} from 'angular2/core';

@Pipe({
	name: 'pretragaKrevet';
})

export class PretragaKrevetPipe{
	transform (value, [queryString]) {
    if (value==null) {
      return null;
    }
    console.log('transform');
	
    return value.filter(item=>item.krevet.toLowerCase().indexOf(queryString.toLowerCase()) !== -1;
  }
}
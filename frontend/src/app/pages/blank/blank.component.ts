import { Component, OnInit } from '@angular/core';
import { ZoneService } from './../../services/zone.service';


@Component({
  selector: 'app-blank',
  templateUrl: './blank.component.html',
  styleUrls: ['./blank.component.scss'],
})
export class BlankComponent implements OnInit {
  zones: any;

  constructor(private zoneService: ZoneService) { }

  ngOnInit() {
    this.zoneService.getZone()
      .subscribe(zones => {
        this.zones = zones;
        console.log(zones);
    });
  }

}

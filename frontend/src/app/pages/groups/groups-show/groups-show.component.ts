import { Component, OnInit } from '@angular/core';
import { GroupsService } from 'src/app/services/groups.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-groups-show',
  templateUrl: './groups-show.component.html',
  styleUrls: ['./groups-show.component.scss'],
})
export class GroupsShowComponent implements OnInit {
  private id:string;
  private groupId:string;
  headings: any;

  constructor(
    private route: ActivatedRoute,
    private groupService: GroupsService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id') && paraMap.has('groupId')){
        this.id = paraMap.get('id');
        this.groupId = paraMap.get('groupId');

        this.groupService.getRateAndScore(this.id, this.groupId)
        .subscribe(response => {
        this.headings = response;
        });
      }
    });
  }

}

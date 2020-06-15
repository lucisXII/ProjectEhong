import { Component, OnInit } from '@angular/core';
import { GroupsService } from 'src/app/services/groups.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-groups-add',
  templateUrl: './groups-add.component.html',
  styleUrls: ['./groups-add.component.scss'],
})
export class GroupsAddComponent implements OnInit {
  private id:string;
  private groupId:string;
  headings: any;
  subs: any;
  subsOnes: any;

  constructor(
    private route: ActivatedRoute,
    private groupService: GroupsService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        this.groupId = paraMap.get('groupId');
        console.log(this.groupId);
        console.log(this.id);

        this.groupService.getHeadings(this.groupId)
        .subscribe(response => {
        this.headings = response;
        console.log(this.headings);
        });

        this.groupService.getSubHeadings(this.groupId)
        .subscribe(subs => {
        this.subs = subs;
        });

      }
    });
  }

  addScore() {
    this.groupService.addScore(this.id, this.headings);
  }

}

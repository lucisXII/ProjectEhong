import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { GroupsService } from 'src/app/services/groups.service';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-groups-edit',
  templateUrl: './groups-edit.component.html',
  styleUrls: ['./groups-edit.component.scss'],
})
export class GroupsEditComponent implements OnInit {
  private id:string;
  private groupId:string;
  headings: any;
  subs: any;
  subsOnes: any;

  constructor(
    private route: ActivatedRoute,
    private groupService: GroupsService,
    private loading: LoadingService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id') && paraMap.has('groupId')){
        this.id = paraMap.get('id');
        this.groupId = paraMap.get('groupId');
        console.log(this.groupId);
        console.log(this.id);

        this.groupService.getRateAndScore(this.id, this.groupId)
        .subscribe(response => {
        this.headings = response;
        });
      }
    });
  }

  updateScore() {
    console.log(this.headings);
    this.groupService.updateScore(this.id, this.groupId, this.headings);
  }

}

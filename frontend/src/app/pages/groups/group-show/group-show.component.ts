import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { GroupsService } from 'src/app/services/groups.service';
import { NgForm, FormGroup, FormControl } from '@angular/forms';

@Component({
  selector: 'app-group-show',
  templateUrl: './group-show.component.html',
  styleUrls: ['./group-show.component.scss'],
})
export class GroupShowComponent implements OnInit {
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
        .subscribe(headings => {
        this.headings = headings;
        console.log(headings);
        });

        this.groupService.getSubHeadings(this.groupId)
        .subscribe(subs => {
        this.subs = subs;
        });

      }
    });
  }

  addScore(form: NgForm) {
    console.log(form.value);
  }

}

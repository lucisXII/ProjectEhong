import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { GroupsService } from 'src/app/services/groups.service';

@Component({
  selector: 'app-groups-checked',
  templateUrl: './groups-checked.component.html',
  styleUrls: ['./groups-checked.component.scss'],
})
export class GroupsCheckedComponent implements OnInit {
  private id:string;
  groups: any;

  constructor(
    private groupsService: GroupsService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');

      this.groupsService.getCheckedGroups(this.id)
        .subscribe(response => {
          this.groups = response;
          console.log(this.groups);
      });
      }
    });
  }

  viewGroup(id) {
    this.router.navigate(['branch/' + this.id + '/groups/checked/' + id]);
  }

}

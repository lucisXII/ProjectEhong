import { Component, OnInit } from '@angular/core';
import { GroupsService } from 'src/app/services/groups.service';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Router } from '@angular/router';

@Component({
  selector: 'app-groups-list',
  templateUrl: './groups-list.component.html',
  styleUrls: ['./groups-list.component.scss'],
})
export class GroupsListComponent implements OnInit {
  private id:string;
  groups: any;
  checked: any;

  constructor(
    private groupsService: GroupsService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');

        this.groupsService.getGroups()
        .subscribe(response => {
          this.groups = response;
          console.log(this.groups);
      });

      this.groupsService.getShowCheckedGroups(this.id)
      .subscribe(response => {
        this.checked = response;
        console.log(this.checked);
      });
      }
    });
   
   
  }

  viewGroup(GroupId) {
    this.groupsService.checkedGroups(this.id, GroupId);
    // this.router.navigate(['branch/' + this.id + '/groups/' + GroupId + '/add']);
  }

}

import { Component, OnInit } from '@angular/core';
import { GroupsService } from 'src/app/services/groups.service';
import { ActivatedRoute, Router, ParamMap } from '@angular/router';

@Component({
  selector: 'app-groups-list-former',
  templateUrl: './groups-list-former.component.html',
  styleUrls: ['./groups-list-former.component.scss'],
})
export class GroupsListFormerComponent implements OnInit {
  private id:string;
  private month: string;
  private year: string;
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
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');

      this.groupsService.getGroups()
        .subscribe(response => {
          this.groups = response;
          console.log(this.groups);
      });
      }
    });
  }

  viewGroup(id) {
    this.router.navigate(['result/' + this.year + '/' + this.month + '/branch/' + this.id + '/groups/' + id]);
  }

}

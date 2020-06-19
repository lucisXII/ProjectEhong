import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { GroupsService } from 'src/app/services/groups.service';
import { FormerService } from 'src/app/services/former.service';

@Component({
  selector: 'app-groups-former',
  templateUrl: './groups-former.component.html',
  styleUrls: ['./groups-former.component.scss'],
})
export class GroupsFormerComponent implements OnInit {
  private id:string;
  private groupId:string;
  private month: string;
  private year: string;
  headings: any;

  constructor(
    private formerService: FormerService,
    private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        this.groupId = paraMap.get('groupId');
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');
        console.log(this.groupId);

      this.formerService.getRateAndScore(this.id, this.groupId, this.month, this.year)
        .subscribe(response => {
          this.headings = response;
          console.log(this.headings);
      });
      }
    });
  }

}

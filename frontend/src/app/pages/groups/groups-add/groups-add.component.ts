import { Component, OnInit } from '@angular/core';
import { GroupsService } from 'src/app/services/groups.service';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { LoadingService } from 'src/app/services/loading.service';

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
    private groupService: GroupsService,
    private loading: LoadingService
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
      }
    });
  }

  addScore() {
    let count = 0;
    let check = 0;
    let text: string;
    let text2: string;
    this.headings.forEach(score => {
      score.sub_heading.forEach(rate => {
        if(rate.get == null) {
        count++;
        }
        if (rate.get > rate.score) {
          check++;
          console.log('check : '+ rate.subheadingName);
          text = rate.subheadingName;
          if(text2 == null){
            text2 = text.substring(0,4);
          }else{
            text2 = text2 + ", " + text.substring(0,4);
          }
        }
      });
    });
    console.log(count);
    console.log(check);
    if(count > 0) {
      this.loading.presentToastWarning();
    }
    else {
      if (check > 0) {
        //this.loading.presentToastMore();
        this.loading.presentToastWarningText(text2);
      }
      else {
      this.loading.present();
      this.groupService.addScore(this.id, this.headings);
      }
    }

  }

}

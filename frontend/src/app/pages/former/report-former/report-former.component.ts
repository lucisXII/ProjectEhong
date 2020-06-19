import { Component, OnInit } from '@angular/core';
import { FormerService } from 'src/app/services/former.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-report-former',
  templateUrl: './report-former.component.html',
  styleUrls: ['./report-former.component.scss'],
})
export class ReportFormerComponent implements OnInit {
  private id: string;
  private month: string;
  private year: string;
  headers: any;
  date: any;
  users: any;
  scoreGroup: any;
  sumGroup: any;
  remain: any;
  outstanding: any;
  unready: any;
  amount: any;
  total: any;
  pdfObj = null;

  constructor(
    private route: ActivatedRoute,
    private FormerService: FormerService

  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');
        console.log(this.id);

        this.FormerService.getHeadingReportOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.headers = response;
          console.log(this.headers);
        });

        this.FormerService.getDateReportOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.date = response;
          console.log(this.date);
        });

        this.FormerService.getUserReportOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.users = response;
          console.log(this.users);
        });

        this.FormerService.getGroupReportOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.scoreGroup = response;
          console.log(this.scoreGroup);
        });

        this.FormerService.getSumReportOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.sumGroup = response;
          console.log(this.sumGroup);
        });

        //motorcycle Report
        this.FormerService.getRemainOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.remain = response;
          console.log(this.remain);
        });
        this.FormerService.getOutstandingOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.outstanding = response;
          console.log(this.outstanding);
        });
        this.FormerService.getUnreadyOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.unready = response;
          console.log(this.unready);
        });

        //Spares Report
        this.FormerService.getAmountCheckedOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.amount = response;
          console.log(this.amount);
        });

        //Costs Report
        this.FormerService.getCostOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.total = response;
          console.log(this.total);
        });

      }
    });
  }

}

import { Component, OnInit } from '@angular/core';
import { ReportService } from 'src/app/services/report.service';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { ToolsService } from 'src/app/services/tools.service';
import { CostService } from 'src/app/services/cost.service';
import { NavController, Platform } from '@ionic/angular';
import { File } from '@ionic-native/file/ngx';
import { FileOpener } from '@ionic-native/file-opener/ngx';

import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import { SparesService } from 'src/app/services/spares.service';
pdfMake.vfs = pdfFonts.pdfMake.vfs;

@Component({
  selector: 'app-report-checked',
  templateUrl: './report-checked.component.html',
  styleUrls: ['./report-checked.component.scss'],
})
export class ReportCheckedComponent implements OnInit {
  private id: string;
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
    private reportService: ReportService,
    private motorcycleService: MotocyclesService,
    private toolsService: ToolsService,
    private SparesService: SparesService,
    private costService: CostService,
    private navCtrl: NavController,
    private plt: Platform,
    private file: File,
    private fileOpener: FileOpener
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.reportService.getHeadingReport(this.id)
        .subscribe(response => {
          this.headers = response;
          console.log(this.headers);
        });

        this.reportService.getDateReport(this.id)
        .subscribe(response => {
          this.date = response;
          console.log(this.date);
        });

        this.reportService.getUserReport(this.id)
        .subscribe(response => {
          this.users = response;
          console.log(this.users);
        });

        this.reportService.getGroupReport(this.id)
        .subscribe(response => {
          this.scoreGroup = response;
          console.log(this.scoreGroup);
        });

        this.reportService.getSumReport(this.id)
        .subscribe(response => {
          this.sumGroup = response;
          console.log(this.sumGroup);
        });

        //motorcycle
        this.motorcycleService.getRemain(this.id)
        .subscribe(response => {
          this.remain = response;
          console.log(this.remain);
        });
        this.motorcycleService.getOutstanding(this.id)
        .subscribe(response => {
          this.outstanding = response;
          console.log(this.outstanding);
        });
        this.motorcycleService.getUnready(this.id)
        .subscribe(response => {
          this.unready = response;
          console.log(this.unready);
        });

        this.SparesService.getAmountChecked(this.id)
        .subscribe(response => {
          this.amount = response;
          console.log(this.amount);
        });

        this.costService.getCost(this.id)
        .subscribe(response => {
          this.total = response;
          console.log(this.total);
        });

      }
    });
  }

  createPDF() {
    let title: string;
    let leader: string;
    this.headers.forEach(head => {
      title = head.branchName;
      leader = head.leaderName;
    });
    pdfMake.fonts = {
      Roboto: {
      normal: 'Roboto-Regular.ttf',
      bold: 'Roboto-Medium.ttf',
      italics: 'Roboto-Italic.ttf',
      bolditalics: 'Roboto-MediumItalic.ttf'
      }
    };
    
    var docDefinition = {
      content: [
        { text: 'Branch : ' + title , style: 'header' },
        { text: 'Leader : ' + leader , style: 'subheader' },
        { text: 'Date ' + this.date , style: 'date' },
      ],
      style: {
        header: {
          fontSize: 32,
          bold: true,
        },
        subheader: {
          fontSize: 18,
          bold: true,
          margin: [0, 15, 0, 0]
        },
        date: {
          fontSize: 14,
          itatic: true
        }
      }
    }
    this.pdfObj = pdfMake.createPdf(docDefinition);
  }
  downloadPDF() {
    this.pdfObj.download();
  }
}

import { Component, OnInit } from '@angular/core';
import { NavController, Platform } from '@ionic/angular';
import { File } from '@ionic-native/file/ngx';
import { FileOpener } from '@ionic-native/file-opener/ngx';

import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.vfs = pdfFonts.pdfMake.vfs;

@Component({
  selector: 'app-blank',
  templateUrl: './blank.component.html',
  styleUrls: ['./blank.component.scss'],
})
export class BlankComponent implements OnInit {
  letterObj = {
    form: 'Simon',
    to: 'Paul',
    text: 'Learn to create PDF files right inside your Ionic App and store them to your device!'
  }

  pdfObj = null;
  constructor(
    private navCtrl: NavController,
    private plt: Platform,
    private file: File,
    private fileOpener: FileOpener
  ) { }

  ngOnInit() {
  }

  createPdf() {
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
        { text: 'REMINDER', style: 'header' },
        { text: new Date().toTimeString() , alignment: 'right' },

        { text: 'From' , style: 'subheader' },
        { text: this.letterObj.form },

        { text: 'To' , style: 'subheader' },
        this.letterObj.to,

        { text: this.letterObj.text , style: 'story', margin: [0, 20, 0, 20] },

        {
          ul: [
            'Bacon',
            'Rips',
            'BBQ'
          ]
        }
      ],
      style: {
        header: {
          fontSize: 18,
          bold: true,
        },
        subheader: {
          fontSize: 14,
          bold: true,
          margin: [0, 15, 0, 0]
        },
        story: {
          itatic: true,
          alignment: 'center',
          width: '50%'
        }
      }
    }
    this.pdfObj = pdfMake.createPdf(docDefinition);
  }

  downloadPdf() {
    if (this.plt.is('cordova')) {

    } else {
      this.pdfObj.download();
    }
  }
}

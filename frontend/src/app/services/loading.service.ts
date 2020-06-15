import { Injectable } from '@angular/core';
import { LoadingController, ToastController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class LoadingService {
  isLoading = false;

  constructor(
    public loadingController: LoadingController,
    public toastController: ToastController
    ) { }

  async presentToast() {
    return await this.toastController.create({
      color: 'dark',
      message: 'บันทึกข้อมูลเรียบร้อยแล้ว',
      duration: 4000
    }).then(t => {
      t.present().then(() => {
        console.log('toast presented');
      });
    });
  }

  async presentToastWarning() {
    return await this.toastController.create({
      color: 'dark',
      message: 'ไม่สามารถเพิ่มข้อมูลได้ กรุณากรอกข้อมูลให้ครบถ้วน',
      duration: 4000
    }).then(t => {
      t.present().then(() => {
        console.log('toast warning');
      });
    });
  }

  async presentToastMore() {
    return await this.toastController.create({
      color: 'dark',
      message: 'คะแนนประเมินของคุณไม่ถูกต้อง กรุณากรอกข้อมูลให้ถูกต้อง',
      duration: 4000
    }).then(t => {
      t.present().then(() => {
        console.log('toast more');
      });
    });
  }

  async present() {
    this.isLoading = true;
    return await this.loadingController.create({
      cssClass: 'my-custom-class',
      message: 'Please wait...',
    }).then(a => {
      a.present().then(() => {
        console.log('presented');
        if (!this.isLoading) {
          a.dismiss().then(() => console.log('abort presenting'));
        }
      });
    });
  }

  async dismiss() {
    this.isLoading = false;
    return await this.loadingController.dismiss().then(() => console.log('dismissed'));
  }
}

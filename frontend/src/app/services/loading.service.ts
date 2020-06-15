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

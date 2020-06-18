import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { MotorcyclesFormerComponent } from './motorcycles-former.component';

describe('MotorcyclesFormerComponent', () => {
  let component: MotorcyclesFormerComponent;
  let fixture: ComponentFixture<MotorcyclesFormerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MotorcyclesFormerComponent ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(MotorcyclesFormerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

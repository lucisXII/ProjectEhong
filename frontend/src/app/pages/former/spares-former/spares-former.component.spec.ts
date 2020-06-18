import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { SparesFormerComponent } from './spares-former.component';

describe('SparesFormerComponent', () => {
  let component: SparesFormerComponent;
  let fixture: ComponentFixture<SparesFormerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SparesFormerComponent ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(SparesFormerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

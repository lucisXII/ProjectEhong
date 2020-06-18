import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { CostsFormerComponent } from './costs-former.component';

describe('CostsFormerComponent', () => {
  let component: CostsFormerComponent;
  let fixture: ComponentFixture<CostsFormerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CostsFormerComponent ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(CostsFormerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

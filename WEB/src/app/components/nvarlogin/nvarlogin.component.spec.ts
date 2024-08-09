import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NvarloginComponent } from './nvarlogin.component';

describe('NvarloginComponent', () => {
  let component: NvarloginComponent;
  let fixture: ComponentFixture<NvarloginComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [NvarloginComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(NvarloginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

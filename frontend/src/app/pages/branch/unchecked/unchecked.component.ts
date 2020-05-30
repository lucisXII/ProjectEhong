import { Component, OnInit } from '@angular/core';
import { BranchService } from './../../../services/branch.service';

@Component({
  selector: 'app-unchecked',
  templateUrl: './unchecked.component.html',
  styleUrls: ['./unchecked.component.scss'],
})
export class UncheckedComponent implements OnInit {
  unChecked: any;

  constructor(private branchService: BranchService) { }

  ngOnInit() {
    this.branchService.getUnchecked()
      .subscribe(unChecked => {
        this.unChecked = unChecked;
        console.log(unChecked);
    });
  }

}

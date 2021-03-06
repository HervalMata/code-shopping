import { Component, OnInit } from '@angular/core';
import { HttpClient } from "@angular/common/http";

@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {

  categories = [];

  constructor(private http: HttpClient) {

  }

  ngOnInit() {
    const token = window.localStorage.getItem('token');
    this.http.get<any>('http://localhost:8000/api/categories', { headers: { 'Authorization': `Bearer ${token}` } })
      .subscribe((response) => {
        response.data[0].active = false;
        this.categories = response.data
      });
  }

}

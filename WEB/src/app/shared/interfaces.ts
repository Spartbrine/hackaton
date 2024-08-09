export interface Model {
  id: number;
  created_at?:string|Date;
  updated_at?:string|Date;
}

export interface User extends Model {
  name: string;
  password: string;
  email: string;
}

export interface Post extends Model {

  comments?:Comment[]
}

export interface Comemnt extends Model {

}

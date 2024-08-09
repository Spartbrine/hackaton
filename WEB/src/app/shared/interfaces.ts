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
  interactions:string;
  description:string;
  comments?:Comment[]
}

export interface Comment extends Model {

}

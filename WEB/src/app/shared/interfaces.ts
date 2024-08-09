export interface Model {
  id: number;
}

export interface User extends Model {
  name: string;
  password: string;
  email: string;
}


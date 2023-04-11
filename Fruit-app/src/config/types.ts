export interface Fruit {
    id: number;
    name: string;
    family: string;
    fruitOrder:string;
    genus: string;
    nutrition: {
      calories: number;
      fat: number;
      sugar: number;
      carbohydrates: number;
      protein: number;
    };
  }
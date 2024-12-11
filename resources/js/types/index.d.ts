export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Cart {
    id: number;
    product_ids: Array<number>;
    products_count: number;
    user_id: number;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
        cart: Cart;
    };
};

export interface Attributes {
    hasCertificate: number,
}

export interface Product {
    name: string,
    price: number,
    description: string,
    user_id: number,
    units: number,
    category: string,
    imgSrc: string,
    id: number,
    attributes: Attributes,
}

export interface Category {
    name: string
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export interface Product {
    name: string,
    price: number,
    description: string,
    user_id: number,
    units: number,
    category: string,
    imgSrc: string,
    id: number
}

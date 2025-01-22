export interface Membership {
    id: number;
    member_id: number;
    membership_type: string; // e.g., basic, premium, annual, etc.
    start_date: Date;
    end_date: Date;
    status: string; // active/inactive
}

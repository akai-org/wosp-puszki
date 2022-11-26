export type VolunteerType = 'Wolontariusz' | 'admin' | 'superadmin';

export interface Option {
  value: VolunteerType;
  label: string;
}

export interface IdNumber {
  idNumber: string;
}

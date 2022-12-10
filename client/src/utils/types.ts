export interface SubNavLink {
  label: string;
  link: string;
}

export type VolunteerType = 'collector' | 'admin' | 'superadmin' | 'collectorcoordinator';

export interface Option {
  value: VolunteerType;
  label: string;
}

export interface IdNumber {
  idNumber: string;
}

interface actions {
  title: string;
  link: string;
}

export interface TableColumns {
  titleName: string;
  keyName: string;
  sortType?: 'number' | 'string' | 'date';
  search?: boolean;
  actions?: actions[];
}

// gdy będą jakieś dane z backendu to podmienić na odpowiedni typ
export interface DataType {
  key: string;
  name: string;
  age: number;
  address: string;
  date: string;
}

export interface SubNavLink {
  url: string;
  label: string;
  withDot?: boolean;
}

export type VolunteerType = 'collector' | 'admin' | 'superadmin' | 'collectorcoordinator';

export interface Option {
  value: VolunteerType;
  label: string;
}

export interface IdNumber {
  idNumber: string;
}

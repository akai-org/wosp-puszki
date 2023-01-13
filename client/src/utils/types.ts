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

export interface TableColumns {
  titleName: string;
  keyName: string;
  sortType?: 'number' | 'string' | 'date';
  search?: boolean;
  actions?: {
    title: string;
    link: string;
    color?: string;
  }[];
  fixed?: 'left' | 'right';
  width?: number;
  beforeText?: string;
  afterText?: string;
  status?: {
    key: string;
    options: {
      on: { value: string | number | boolean; description: string };
      off: { value: string | number | boolean; description: string };
    };
  };
}

// gdy będą już jakieś dane z API to podmienić
export type DataType = {
  key: string;
  name: string;
  amount_EUR: number;
  amount_GBP: number;
  amount_USD: number;
  amount_PLN: number;
  more: string;
  position: string;
  time_counted: string;
  is_confirmed: number;
};

export type BoxDataType = {
  box_id: string;
  volunteer_id: number;
  name: string;
  amount_EUR: number;
  amount_GBP: number;
  amount_USD: number;
  amount_PLN: number;
  status: string;
  give_hour: string;
};

export type VolunteerDataType = {
  volunteer_id: number;
  name: string;
  sur_name: string;
  id: string;
  amount_PLN: number;
  status: string;
};

export type UserDataType = {
  user_id: string;
  name: string;
  role: string;
};

export type LogDataType = {
  user: string;
  volunteer_id: string;
  box: string;
  action: string;
  other: string;
  time: string;
};

export type volunteerStatus = 'available' | 'occupied' | 'unavailable';

export type volunteerStatusClass =
  | 'volunteer-available'
  | 'volunteer-occupied'
  | 'volunteer-unavailable';

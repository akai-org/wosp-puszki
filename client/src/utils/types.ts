import { ReactNode } from 'react';

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

export type currencies = 'pln' | 'eur' | 'gbp' | 'usd';

export interface IAuthContext {
  createCredentials: (username: string, password: string) => Promise<void>;
  deleteCredentials: () => void;
  credentials: string | null;
  username: string | null;
}

export interface IBoxContext {
  createBox: (
    collectorName: string,
    collectorIdentifier: string,
    boxIdentifier: string,
  ) => Promise<void>;
  deleteBox: () => void;
  collectorName: string | null;
  collectorIdentifier: string | null;
  boxIdentifier: string | null;
}

export type formMessageType = 'error' | 'success';

export interface FormMessage {
  type: formMessageType;
  content: ReactNode;
}

export interface boxResponse {
  id: number;
  collectorIdentifier: string;
  collector_id: number;
  is_given_to_collector: boolean;
  given_to_collector_user_id: number;
  time_given: string;
  is_counted: number;
  counting_user_id: string | null;
  time_counted: string | null;
  is_confirmed: number;
  user_confirmed_id: string | null;
  time_confirmed: string | null;
  count_1gr: number;
  count_2gr: number;
  count_5gr: number;
  count_10gr: number;
  count_20gr: number;
  count_50gr: number;
  count_1zl: number;
  count_2zl: number;
  count_5zl: number;
  count_10zl: number;
  count_20zl: number;
  count_50zl: number;
  count_100zl: number;
  count_200zl: number;
  count_500zl: number;
  amount_PLN: string;
  amount_EUR: string;
  amount_USD: string;
  amount_GBP: string;
  comment: string;
  created_at: string;
  updated_at: string;
  is_special_box: number;
  collector: {
    id: number;
    identifier: string;
    firstName: string;
    lastName: string;
    created_at: string;
    updated_at: string;
  };
}

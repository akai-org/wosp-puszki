import { filter } from 'lodash';
import {
  DisplayableData,
  IBoxes,
  LogDataType,
  Volunteer,
  VolunteerDataType,
} from '../types';

export const createDisplayableData = (data: IBoxes[]) => {
  const displayableData = [];

  for (const item of data) {
    const name = `${item.collector.firstName} ${item.collector.lastName}`;

    displayableData.push({
      id: item.collectorIdentifier,
      name: name,
      amount_EUR: item.amount_EUR,
      amount_GBP: item.amount_GBP,
      amount_USD: item.amount_USD,
      amount_PLN: item.amount_PLN,
      comment: item.comment,
      time_counted: item.time_counted,
    });
  }

  return displayableData as DisplayableData[];
};

export const createDisplayableLogData = (data: LogDataType[]) => {
  const displayableLogData = [];

  for (const [index, item] of data.entries()) {
    displayableLogData.push({
      log_id: index,
      name: item.user.name,
      user_id: item.user_id,
      box_id: item.box_id,
      type: item.type,
      comment: item.comment,
      created_at: item.created_at,
    });
  }

  return displayableLogData as DisplayableData[];
};

export const createDisplayableVolunteersData = (data: Volunteer[]) => {
  const displayableVolunteersData: VolunteerDataType[] = [];

  for (const [, item] of data.entries()) {
    displayableVolunteersData.push({
      amount_PLN: item.boxes.reduce((acc, curr) => acc + parseFloat(curr.amount_PLN), 0),
      id: item.identifier,
      name: item.firstName,
      status:
        filter(item.boxes, (box) => !(box.is_confirmed && box.is_counted)).length !== 0
          ? 'unsettled'
          : 'settled',
      sur_name: item.lastName,
      volunteer_id: item.id.toString(),
    });
  }

  return displayableVolunteersData;
};

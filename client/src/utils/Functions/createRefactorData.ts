import { filter } from 'lodash';
import {
  DisplayableData,
  IBoxes,
  LogDataType,
  boxResponse,
  Volunteer,
  VolunteerDataType,
  BoxDataType,
} from '../types';

export const createDisplayableData = (data: IBoxes[]) => {
  const displayableData = [];

  for (const item of data) {
    const name = `${item.collector.firstName} ${item.collector.lastName}`;

    displayableData.push({
      id: item.id,
      collectorId: item.collectorIdentifier,
      name: name,
      amount_EUR: item.amount_EUR,
      amount_GBP: item.amount_GBP,
      amount_USD: item.amount_USD,
      amount_PLN: item.amount_PLN,
      comment: item.comment,
      countingStation: item.counting_user_id > 3 ? item.counting_user_id - 3 : null,
      time_counted: new Date(item.time_counted).toLocaleTimeString(),
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

export const createDisplayableBoxData = (data: boxResponse[], onlyUnsettled = false) => {
  const displayableBoxData: BoxDataType[] = [];
  for (const [, item] of data.entries()) {
    const isBoxSettled = item.is_confirmed && item.is_counted;
    if (onlyUnsettled && isBoxSettled) continue;
    displayableBoxData.push({
      amount_EUR: item.amount_EUR,
      amount_GBP: item.amount_GBP,
      amount_USD: item.amount_USD,
      amount_PLN: item.amount_PLN,
      id: item.id,
      give_hour: new Date(item.time_given).toLocaleTimeString(),
      name: `${item.collector.firstName} ${item.collector.lastName}`,
      status: (item.is_counted || item.counting_user_id != null) ? 'settled' : 'unsettled',
      volunteer_id: item.collectorIdentifier,
    });
  }
  return displayableBoxData;
};

export const createDisplayableVolunteersData = (data: Volunteer[]) => {
  const displayableVolunteersData: VolunteerDataType[] = [];

  for (const [, item] of data.entries()) {
    displayableVolunteersData.push({
      amount_PLN: item.boxes.reduce((acc, curr) => acc + parseFloat(curr.amount_PLN), 0),
      id: item.identifier,
      name: item.firstName,
      status: getStatusName(item.boxes),
      sur_name: item.lastName,
      volunteer_id: item.id.toString(),
      phone_number: item.phoneNumber || ""
    });
  }

  return displayableVolunteersData;
};

function getStatusName(boxes: Omit<boxResponse, 'collector'>[]): string {
  return filter(boxes, (box) => !(box.is_confirmed && box.is_counted)).length !== 0
            ? 'Nierozliczona'
            : 'Rozliczona'
}

interface LineItem {
    Name: string;
    Id: number;
}
  
interface DomainItem {
    did: number;
    /** 域名 */
    domain: string;
    /** 所需积分 */
    point: number;
    /** 描述 */
    desc: string;
    line: LineItem[];
}
  
type DomainList = DomainItem[];


interface RecordDomain {
    did: number;
    domain: string;
}

interface RecordItem {
    id: number,
    uid: number,
    did: number,
    record_id: string,
    name: string,
    link: string,
    type: string,
    value: string,
    line_id: string,
    line: string,
    created_at: string,
    updated_at: string,
    checked_at: number,
    domain: RecordDomain;
    deleteing: boolean;
}
  
type RecordList = RecordItem[];
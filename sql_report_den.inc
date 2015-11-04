select p.cid,d.hn,concat(DAY(d.vstdate),"/",MONTH(d.vstdate),"/",(YEAR(d.vstdate)+543)) as vst_date,concat(p.pname,p.fname,"  ",p.lname) as patient_name,concat(DAY(p.birthday),"/",MONTH(p.birthday),"/",(YEAR(p.birthday)+543)) as Birth_date
,i.code as icd10,i.name as icd_name,d.ttcode,dr.name as doctor,v.income,dm.name as tmcode_name
from dtmain d
left outer join doctor dr on dr.code=d.doctor
left outer join patient p on p.hn=d.hn
left outer join icd101 i on i.code=d.icd
left outer join vn_stat v on v.vn=d.vn
left outer join dttm dm on dm.code=d.tmcode
where  v.pcode='A7' and d.vstdate between '2005-11-01' and  '2006-02-31'
group by d.vn
order by d.vstdate